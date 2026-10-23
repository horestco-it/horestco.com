<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WcStore - WooCommerce Store API Client with file caching
 * Consumes public Store API from horestco.com.my without pricing
 */
class Wcstore
{
    protected $api_url = 'https://horestco.com.my/wp-json/wc/store/v1/';
    protected $cache_dir;
    protected $cache_ttl = 1800; // 30 minutes cache

    public function __construct()
    {
        $this->cache_dir = APPPATH . 'cache/wc/';
        if (!is_dir($this->cache_dir)) {
            @mkdir($this->cache_dir, 0777, true);
        }

        // Allow overriding API url from setting.ini.php if defined
        if (file_exists(FCPATH . 'setting.ini.php')) {
            $ini = @parse_ini_file(FCPATH . 'setting.ini.php', true);
            if (!empty($ini['WC']['api_url'])) {
                $this->api_url = rtrim($ini['WC']['api_url'], '/') . '/';
            }
        }
    }

    /**
     * Fetch all product categories
     */
    public function getCategories()
    {
        $cacheKey = 'categories_all';
        $cached = $this->getCache($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $res = $this->request('products/categories?per_page=100');
        if (!is_array($res)) {
            return [];
        }

        $categories = [];
        foreach ($res as $item) {
            $categories[] = (object)[
                'id' => (int)$item['id'],
                'name' => html_entity_decode($item['name']),
                'slug' => $item['slug'],
                'parent' => (int)($item['parent'] ?? 0),
                'count' => (int)($item['count'] ?? 0),
                'link' => $item['link'] ?? '',
                'image' => !empty($item['image']) ? $item['image']['src'] : null,
            ];
        }

        $this->setCache($cacheKey, $categories, $this->cache_ttl);
        return $categories;
    }

    /**
     * Get single category by slug
     */
    public function getCategoryBySlug($slug)
    {
        $all = $this->getCategories();
        foreach ($all as $cat) {
            if ($cat->slug === $slug) {
                return $cat;
            }
        }
        return null;
    }

    /**
     * Get subcategories for a parent category ID
     */
    public function getSubcategories($parentId)
    {
        $all = $this->getCategories();
        $subs = [];
        foreach ($all as $cat) {
            if ($cat->parent == $parentId && $cat->count > 0) {
                $subs[] = $cat;
            }
        }
        return $subs;
    }

    /**
     * Fetch products list with optional category filter, pagination & search
     */
    public function getProducts($params = [])
    {
        $endpoint = 'products';
        $query = [];

        if (!empty($params['category'])) {
            $query['category'] = $params['category'];
        }
        if (!empty($params['search'])) {
            $query['search'] = $params['search'];
        }
        $query['page'] = !empty($params['page']) ? (int)$params['page'] : 1;
        $query['per_page'] = !empty($params['per_page']) ? (int)$params['per_page'] : 24;

        $cacheKey = 'products_' . md5(serialize($query));
        $cached = $this->getCache($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $url = $endpoint . '?' . http_build_query($query);
        $res = $this->request($url);

        if (!is_array($res)) {
            return [];
        }

        $products = [];
        foreach ($res as $item) {
            $products[] = $this->transformProduct($item);
        }

        $this->setCache($cacheKey, $products, $this->cache_ttl);
        return $products;
    }

    /**
     * Get single product by ID
     */
    public function getProduct($id)
    {
        $id = (int)$id;
        if ($id <= 0) return null;

        $cacheKey = 'product_' . $id;
        $cached = $this->getCache($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $res = $this->request('products/' . $id);
        if (!is_array($res) || empty($res['id'])) {
            return null;
        }

        $product = $this->transformProduct($res);
        $this->setCache($cacheKey, $product, $this->cache_ttl);
        return $product;
    }

    /**
     * Get related products for a product
     */
    public function getRelatedProducts($product, $limit = 6)
    {
        if (empty($product->category['id'])) {
            return [];
        }

        $catId = $product->category['id'];
        $products = $this->getProducts(['category' => $catId, 'per_page' => $limit + 1]);

        $filtered = [];
        foreach ($products as $p) {
            if ($p->id != $product->id) {
                $filtered[] = $p;
            }
            if (count($filtered) >= $limit) {
                break;
            }
        }
        return $filtered;
    }

    /**
     * Transform Store API item into format expected by Horestco views
     */
    protected function transformProduct(array $item)
    {
        $obj = new stdClass();
        $obj->id = (int)$item['id'];
        $obj->name = html_entity_decode($item['name'] ?? '');
        $obj->slug = $item['slug'] ?? '';
        $obj->code = !empty($item['sku']) ? $item['sku'] : '';
        $obj->sku = $obj->code;
        $obj->description = $item['description'] ?? '';
        $obj->short_description = $item['short_description'] ?? '';
        $obj->stock = !empty($item['is_in_stock']) ? 'In Stock' : 'Upon Request';
        $obj->is_promo = false;

        // Process images
        $images = [];
        if (!empty($item['images']) && is_array($item['images'])) {
            foreach ($item['images'] as $idx => $img) {
                $src = $img['src'] ?? '';
                $thumb = $img['thumbnail'] ?? $src;
                $images[] = (object)[
                    'id' => (int)($img['id'] ?? $idx),
                    'name' => $src,
                    'src' => $src,
                    'thumbnail' => $thumb,
                    'is_primary' => ($idx === 0) ? 1 : 0,
                    'alt' => $img['alt'] ?? $obj->name,
                ];
            }
        }

        $primarySrc = !empty($images[0]->src) ? $images[0]->src : base_url('assets/images/not-available.jpg');
        $obj->images = $images;
        $obj->imageThumb = ['name' => $primarySrc, 'id' => $images[0]->id ?? 0];

        // Process categories
        $primaryCat = ['id' => 0, 'name' => 'Furniture', 'slug' => 'furniture'];
        $primarySubcat = ['id' => 0, 'name' => 'All', 'slug' => 'all'];

        if (!empty($item['categories']) && is_array($item['categories'])) {
            if (isset($item['categories'][0])) {
                $c = $item['categories'][0];
                $primarySubcat = [
                    'id' => (int)$c['id'],
                    'name' => html_entity_decode($c['name']),
                    'slug' => $c['slug']
                ];
            }
            if (isset($item['categories'][1])) {
                $c = $item['categories'][1];
                $primaryCat = [
                    'id' => (int)$c['id'],
                    'name' => html_entity_decode($c['name']),
                    'slug' => $c['slug']
                ];
            } else {
                $primaryCat = $primarySubcat;
            }
        }
        $obj->category = $primaryCat;
        $obj->subcategory = $primarySubcat;

        // Process dimensions / sizes from attributes
        $dimensions = '';
        if (!empty($item['attributes']) && is_array($item['attributes'])) {
            foreach ($item['attributes'] as $attr) {
                $attrName = strtolower($attr['name'] ?? '');
                if (strpos($attrName, 'dimension') !== false || strpos($attrName, 'size') !== false) {
                    if (!empty($attr['terms']) && is_array($attr['terms'])) {
                        $termNames = array_map(function($t) { return $t['name'] ?? ''; }, $attr['terms']);
                        $dimensions = implode(', ', array_filter($termNames));
                    }
                }
            }
        }
        if (empty($dimensions) && !empty($item['formatted_dimensions'])) {
            $dimensions = $item['formatted_dimensions'];
        }

        // Mock size object for detail views
        $sizeObj = (object)[
            'id' => 1,
            'name' => 'Standard',
            'dimension' => $dimensions,
            'prices' => (object)[
                'normal' => '',
                'promo' => '',
                'promo_note' => ''
            ]
        ];
        $obj->sizes = [$sizeObj];

        // Mock empty prices & relations collection to prevent errors in legacy views
        $obj->prices = ['promo' => false];
        $obj->relations = [];
        $obj->materials = [];
        $obj->pdf = '';

        return $obj;
    }

    /**
     * HTTP Request via cURL
     */
    protected function request($endpoint)
    {
        $url = $this->api_url . ltrim($endpoint, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 12);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Horestco-Catalog-Frontend/1.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300 && $response) {
            return json_decode($response, true);
        }

        return null;
    }

    /**
     * File Cache Get
     */
    protected function getCache($key)
    {
        $file = $this->cache_dir . preg_replace('/[^a-zA-Z0-9_-]/', '_', $key) . '.cache';
        if (file_exists($file)) {
            $content = @file_get_contents($file);
            if ($content) {
                $data = @unserialize($content);
                if (is_array($data) && isset($data['expires']) && $data['expires'] > time()) {
                    return $data['value'];
                }
                @unlink($file);
            }
        }
        return null;
    }

    /**
     * File Cache Set
     */
    protected function setCache($key, $value, $ttl)
    {
        $file = $this->cache_dir . preg_replace('/[^a-zA-Z0-9_-]/', '_', $key) . '.cache';
        $data = [
            'expires' => time() + $ttl,
            'value' => $value
        ];
        @file_put_contents($file, serialize($data));
    }
}
