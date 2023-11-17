<?php $this->load->view('template/default/header.php') ?>
<style>
  .lead.background-image{
    background-image: 
      linear-gradient(
        rgba(0, 0, 0, 0.7), 
        rgba(0, 0, 0, 0.7)
      ),
      url('<?=base_url().img_url()?>slide-index/bar-chair.jpg');
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
  }
  .collapsible{
    margin-bottom: 1.1rem;
    box-shadow: none;
  }

  .collapsible .collapsible-header{
    font-weight: 500;
  }
  
  .collapsible-body{
    padding: 1.5rem 4rem;
  }
  .tabs .tab > a{
    color: #333;
  }
  .tabs .tab > a.active{
    background-color: #eee;
  }
  .tabs .tab > a:hover{
    color: #333;
    background-color: #f5f5f5;
  }
</style>
<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

  <div class="section lead background-image">
    <div class="container">
      <div class="row">
        <div class="col s12 center white-text">
          <h3 class="lead-heading">FAQ</h3>
          <h5 class="lead-sub-heading">
          Frequently asked questions related to furniture purchases.
          </h5>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="parallax"><img src="<?=img_url('slide-index/slide3-1.jpg')?>"></div> -->

<section class="section container">
  <div class="row">
    <div class="col s12">
      <ul class="tabs tabs-faq tabs-fixed-width">
        <li class="tab col s3">
          <a href="#tab1" class="<?=$this->input->get('tab') && $this->input->get('tab') == 'local-customers' ? 'active':'' ?>">Local Customers (Malaysia)</a>
        </li>
        <li class="tab col s3">
          <a href="#tab2" class="<?=$this->input->get('tab') && $this->input->get('tab') == 'local-dealers' ? 'active':'' ?>">Local Dealers</a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="item" id="tab1">
    <h4 class="">Local Customers (Malaysia)</h4>

    <div class="teal-text text-lighten-2">Discounts</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco offer any Discounts?
        </div>
        <div class="collapsible-body">
          <p style="padding-bottom:1rem">
            <span>Yes we do have various ongoing promotions.</span><br/>
          </p>
          <ol style="margin-left:2.5rem;margin-bottom:3rem">
            <li>Self Collection Discount as per below (** refer to subcategory TRANSPORTATION).</li>
            
            <li>Refer to our <a href="<?=base_url('malaysia-furniture-promotions')?>">PROMOTIONS/CLEARANCE PAGE</a> on our website for promotions on certain items.</li>
            <li>
              Other Promotion details are in the file <a href="https://docs.google.com/spreadsheets/d/1IHMKqJmk26Ga2EXTp3oCUdjaI0RL5TGiclv7DLekbsI/edit?usp=sharing">PROMOTIONS AND DISCOUNT SCHEMES</a> on Google Drive in sheet OVERVIEW.<br/>
              *Note : Refer to the sheet Parameters to check under which category the enquiry falls.
            </li>
          </ol>
        </div>
      </li>
    </ul>
    
    <div class="teal-text text-lighten-2">Transportation / Delivery / Lead Times</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide Transportation?
        </div>
        <div class="collapsible-body">
          <p>
            <span>For the convenience of both Horestco and the Client, we prefer self collection of the furniture. Should the client agree to self collection a discount of 5% can be given to a maximum discount amount of RM 250.</span><br/><br/>
            For Example : Total bill value (not including GST) = RM 2500 <br/>
            2500 * 5% = RM 125 <br/>
            New Total  (not including GST) = RM 2500 - RM 125 = RM 2375
            <br/><br/>
            Total bill value (not including GST) = RM 8500 <br/>
            8500 * 5% = RM 425 <br/>
            However maximum discount is RM 250 only <br/>
            New Total  (not including GST) = RM 8500 - RM 250 = RM 8250
            <br/><br/>
            Yes. Transportation can be arranged by Horestco with additional Delivery charges. 
            Customers can however choose to arrange their own transportation as well. 
            Delivery charges are available in the online file <a target="_blank" href="https://docs.google.com/a/horestco.com/spreadsheets/d/15NpBCs7Y_NdEIORIGywOP6nCkSIFf1E2SnEQ9sPFmrE/edit?usp=sharing">"Transport/lorry”</a>.
          </p> 
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Order online through <a href="https://horestco.com.my">www.horestco.com.my</a> or other related horestco owned platforms, does the customer have to pay delivery charges?
        </div>
        <div class="collapsible-body">
          <p>
            Within klang valley: <strong>free delivery</strong><br/>
            Outstation: Customer needs to pay.  please refer to the <a target="_blank" href="https://docs.google.com/spreadsheets/d/15NpBCs7Y_NdEIORIGywOP6nCkSIFf1E2SnEQ9sPFmrE/edit#gid=1864905055&range=1:1">transport charges</a> sheet on Drive.
          </p> 
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can the customer get goods on a specific date and time?
        </div>
        <div class="collapsible-body">
          <p>
            We try as much as we can to deliver on customers' flexible date and time, However for online orders we use a 3rd party logistics company where we do not have a control of time. The goods can be delivered either one day earlier or later. 
          </p> 
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Delivery Lead Time:
        </div>
        <div class="collapsible-body">
          <p>
            For Stock Items: 7-10 working days.
          </p>
          <p>
            For Non-Stock Items: (Follow below table).
          </p>
          <div class="row">
            <div class="col s6">
  
              <table class="responsive-table bordered">
                <thead>
                  <tr>
                    <th>Material</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Custom Wooden / Mix Material</td>
                    <td>:</td>
                    <td>10 weeks</td>
                  </tr>
                  <tr>
                    <td>Custom Wicker / Metal Material</td>
                    <td>:</td>
                    <td>10 weeks</td>
                  </tr>
                  <tr>
                    <td>Standar Wooden / Mix Material</td>
                    <td>:</td>
                    <td>8 weeks</td>
                  </tr>
                  <tr>
                    <td>Standar Wicker / Metal Material</td>
                    <td>:</td>
                    <td>6 weeks</td>
                  </tr>
                  <tr>
                    <td>Standar / Custom Cushions</td>
                    <td>:</td>
                    <td>4 weeks</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </li>
    </ul>
  
    <?php
      $items = [
        [
          'material' => 'Stainless steel frame',
          'commercial' => '3 years',
          'residential' => '5 years',
          'export' => '3 years'
        ],
        [
          'material' => 'Teak',
          'commercial' => '3 years',
          'residential' => '5 years',
          'export' => '3 years'
        ],
        [
          'material' => 'Batyline',
          'commercial' => '2 years',
          'residential' => '3 years',
          'export' => '2 years'
        ],
        [
          'material' => 'Wicker furniture',
          'commercial' => '3 years',
          'residential' => '3 years',
          'export' => '3 years'
        ],
        [
          'material' => 'Umbrella wooden frames',
          'commercial' => '1 years',
          'residential' => '3 years',
          'export' => '1 years'
        ],
        [
          'material' => 'Umbrella Stainless steel frames',
          'commercial' => '5 years',
          'residential' => '8 years',
          'export' => '5 years'
        ],
        [
          'material' => 'Umbrella Aluminium frames',
          'commercial' => '3 years',
          'residential' => '5 years',
          'export' => '3 years'
        ],
        [
          'material' => 'Sunbrella fabric',
          'commercial' => '5 years',
          'residential' => '8 years',
          'export' => '5 years'
        ],
        [
          'material' => 'Sunproof fabric',
          'commercial' => '1 years',
          'residential' => '1 years',
          'export' => '1 years'
        ],
        [
          'material' => 'Custom made furniture',
          'commercial' => '1 years',
          'residential' => '1 years',
          'export' => '1 years'
        ],
      ];
    ?>
  
    <div class="teal-text text-lighten-2" style="margin-top: 2rem">Warranties:</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide warranties on their products?
        </div>
        <div class="collapsible-body">
          <div class="row">
            <div class="col s12 m6">
              <table class="responsive-table bordered">
                <thead>
                  <tr>
                    <th>Material Type</th>
                    <th>Commercial Use</th>
                    <th>Residential Use</th>
                    <th>Export</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($items as $key => $item): ?>
                  <tr>
                    <td><?=$item['material']?></td>
                    <td><?=$item['commercial']?></td>
                    <td><?=$item['residential']?></td>
                    <td><?=$item['export']?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <p>The above warranties are covered Under reasonable conditions of usage and maintenance,</p>
          <p>"Defects" as used in this warranty is defined as - imperfections which impair the utility of the product or affect the structural integrity of the product. Upon receipt of the product the customer must inspect components thoroughly prior to assembly, and any defects which impair the utility of the product should be noted and reported within seven days of receipt. The warranty does not apply to normal wear and tear of teak furniture or to checking (fine cracks that appear on surface of teak wood or ends, once the product is exposed to the elements). Checking/cracking is completely normal and does not impair the utility of the product. Natural wood products can have color and grain variations, and are not considered a "defect" under warranty.</p>
          <p>This warranty does not cover damage resulting from misuse, negligent use, negligence during assembly, unauthorized repairs, unauthorized parts,, infestation, fire, negligence, hurricanes, tornadoes, floods, typhoons, cyclones, wind damage and other acts of God.  This warranty does not cover damage from unknown sources. Any defects must be reported as soon as they occur and within the warranty period. Detailed photos will be requested to determine whether the damage is from manufacturing defects.  This warranty does not cover breakage of brass components beyond the period of 1 year, after which such breakage will be considered normal wear and tear. This warranty does not cover normal tarnishing of metal (for eg. brass) used in hinges, mechanisms etc.</p>
  
        </div>
      </li>
    </ul>
  
    <div class="teal-text text-lighten-2" style="margin-top: 2rem">Clearance items</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Clearance items:
        </div>
        <div class="collapsible-body">
            <p>Clearance and Final Sale items are provided As Is with no warranty or returns.</p>
            <p>Customers must provide photographs of the defect to the seller ( place at which the item has been purchased)in order to determine  the extent of the defect and its most efficient resolution.</p>
            <p>The Warranty is limited to replacement of the parts of the furniture that show a defect. For the first year after purchase, Horestco will ship/ replacement/repair parts at no charge.</p>
            <p>If the furniture component is deemed defective within the terms of the Warranty, Horestco will furnish a repaired or replacement component at no cost to the consumer for the first year after purchase, and charge actual shipping costs for the component after the first year and through the third year after purchase.   In the event of part replacement no assembly or repair costs are covered. Discoloration of wood is not a defect and hence not covered under warranty.</p>
            <p>This warranty does not cover shipping damage. Shipping damage must be reported immediately upon receipt directly to Horestco. Please email info@horestco.com about shipping damage immediately upon receipt of damaged merchandise. Please save all cartons. If a customer signs the shipping company delivery receipt "received in good condition", or does not report shipping damage directly to Horestco within 48 hours of receipt, no shipping damage claim will be honored by Horestco. </p>
            <p>Chair Glides are recommended for rough surfaces.  It is the consumer's responsibility to periodically inspect Furniture Components, including hardware ( like bolts, hinges or other mechanisms) and wood, for missing hardware or defects.</p>
            <p>The terms of this warranty may change without notice, but will not be changed in a way that eliminates your original warranty.</p>
        </div>
      </li>
    </ul>
  
    <div class="teal-text text-lighten-2" style="margin-top: 2rem">Using Outdoor Cushions on Teak</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Using Outdoor Cushions on Teak:
        </div>
        <div class="collapsible-body">
            <p><strong>Before placing any cushions on furniture</strong>, remove any dust or dirt by wiping the furniture with a damp cloth. Your premium teak furniture has been fine sanded and there may be some fine residue even after cleaning during manufacture. </p>
            <p>Your teak furniture naturally contains oil. Expect some of the natural teak oil transfer to the light color cushions. In order to protect your cushions, bring them in when you are expecting rain, or when the furniture is wet. Once the furniture has started weathering (changing color) it is no longer necessary to remove the cushions. </p>
            <p>If you Teak Oil your  furniture, please make sure the Teak Oil is completely dry before placing your cushions on the furniture.</p>
            <p>If your cushion gets some marks or discoloration due to saw dust or teak's natural oil as described above, the dirt and discoloration can be removed by light scrubbing with a sponge with dishwashing liquid(like Dawn) and then hosing off the surface. If stronger measures are needed,  we recommend to use a stain remover product. You can remove any stains while the covers are on the cushion. If you wish to remove the covers to clean in a washer, you can do that – but please air dry them rather than putting them in a dryer.</p>
        </div>
      </li>
    </ul>
  
    <div class="teal-text text-lighten-2" style="margin-top: 2rem">Common</div>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Refund/Return/exchange
        </div>
        <div class="collapsible-body">
            <p>
              At Horestco, we ensure the goods delivered are thoroughly checked and inspected before delivery. We do not encourage any refunds or return without a valid reason, however we encourage customers to check the goods upon delivery. If the item is returned upon delivery with a valid and acceptable reason, Horestco will re-deliver the goods at its own cost after rectification or exchange one to one. <br/>
              If returned items need to be picked up from a customer’s place , a pickup fee will be applicable apart from Your initial delivery fee.<br/>
              No refund or exchange is accepted on custom made or made on order items.
            </p>
            <p>
              Due to any reason if there is any cancellation (standard items only, not applicable for make on order), a fee of 3% of the order is chargeable or RM 300.00 per order whichever is higher.
              Upon receipt of returned goods, the items will be inspected. If the returned item is in acceptable condition , the refund will be processed within 7 working days. Refund process may take upto 14 working days after the written acceptance/confirmation of returned goods by Horestco. 
            </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco produce customized products?
        </div>
        <div class="collapsible-body">
            <p>
              Yes. Customisation of size and colour is possible.<br/>
              For Resellers and Project Orders, customisation or production of completely new products is possible. 
            </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can customer select his/her own color?
        </div>
        <div class="collapsible-body">
            <p>
              Yes. Customer can choose from various color options* available with Horestco. <br/>
            </p>
            <p><em>Timber Finishing / Colors</em></p>
            <p><strong>For Retail orders</strong>, we are able to use multiple wood stains and wood gels. But we are unable to do Acrylic / Emulsion based colors, e.g., Red, white, black, blue. </p>
            <p><strong>For Project Orders</strong>, we are able to use multiple wood stains and wood gels as well as Acrylic based colors, e.g., Red, white, black, blue. </p>
            <p>For other materials (such as Glass, metals, wicker, fabric), please check with us for multiple color/finishing options.  </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide After Sales Service?
        </div>
        <div class="collapsible-body">
            <p>
            Yes. Subject to additional service charges. <br/>
            </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          How to maintain the furniture?
        </div>
        <div class="collapsible-body">
            <p>
              The various materials we use in our furniture are listed below along with the maintenance instructions. <br/>
            </p>
            <ol>
              <li>Teak Timber</li>
              <li>Balau / Bengkirai timber</li>
              <li>Acacia Timber</li>
              <li>High Pressure Laminate </li>
              <li>Stainless Steel</li>
              <li>Mild Steel </li>
              <li>Synthetic Wicker. </li>
              <li>Powder Coated Aluminium</li>
              <li>Sunbrella Fabric</li>
              <li>Sunproof fabric</li>
              <li>Batyline Fabric</li>
            </ol>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide Transit Insurance?
        </div>
        <div class="collapsible-body">
            <p>
            Products delivered by Horestco are covered until door to door delivery. Products delivered through Skynet can be covered under Insurance provided by Skynet. Products self-collected by customers are customers’ responsibility once it leaves the Warehouse/showroom.
            </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          What are the payment options accepted at Horestco?
        </div>
        <div class="collapsible-body">
          <ol>
            <li>Online Transfers</li>
            <li>Credit/Debit Cards</li>
            <li>Cash</li>
  
          </ol>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Payment Terms followed at Horestco?
        </div>
        <div class="collapsible-body">
          <p>
            For Non-Stock Items:<br/>
            50% on order Confirmation<br/>
            50% before shipment (after Inspection of goods)
          </p>
          <p>For Stock Items: 100% on Order Confirmation</p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco charge any taxes?
        </div>
        <div class="collapsible-body">
          <p>
            Yes, we charge taxes as per applicable according to govt laws and regulations. 
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco repair any old furniture (Not bought from Horestco)?
        </div>
        <div class="collapsible-body">
          <p>
          No. Unless it is in bulk.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can you store my furniture until my house/premises is ready?
        </div>
        <div class="collapsible-body">
          <p>
            <strong>Stock Items:</strong> For free upto 3 months from the date of purchase. <br/>
            <strong>After 3 months:</strong> Charges will be 2% of the total purchase per month. <br/>
          </p>
          <p>
            <strong>Non - Stock Items:</strong> For free upto 5 months from the date of purchase. <br/>
            <strong>After 5 months:</strong> Charges will be 2% of the total purchase per month. 
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can you dispose of my old furniture (non-Horestco Brand) when you deliver the new furniture?
        </div>
        <div class="collapsible-body">
          <p>
            We can dispose of Horestco Brand furniture. But we can not dispose your non - Horestco brand furniture. 
          </p>
          <p>
            However, we can recommend some charity organisations that provide the service of collection of old furniture from doorstep.. E.g., 
          </p>
          <p style="margin-left:2em">
            <strong>Community Recycle for Charity (CRC)</strong><br/>
            <span>Lot 13D, Jalan Simpang Balak, Kampung Simpang Balak, 43000 Kajang, Selangor.</span><br/>
            <span>Collection of furniture for Recycling</span><br/>
            <span>0 17 3638 100</span><br/>
            <span>recycle@crcbox.org</span><br/>
            <span>collection of bulk items will take 2 working days to process.</span><br/>
            <span> <a href="http://www.crcbox.com.my">http://www.crcbox.com.my</a></span><br/>
  
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can you send the furniture to Langkawi?
        </div>
        <div class="collapsible-body">
          <p>
          You can choose the items from our website and let us know by email. We will get our dealer to get in touch with yourself. Details of our dealer in Langkawi as below.
          </p>
          <p style="margin-left:2em">
            <span>Company name : <strong>Summer Furnishings (M) Sdn. Bhd.</strong> </span><br/>
            <span>Address : Lot 91, 92 & 93, Persiaran Mutiara 2,</span><br/>
            <span>Kelana Mas Commercial & Tourist Centre,</span><br/>
            <span>Kuah 07000 Langkawi, Kedah</span><br/>
            <span>Contact Person : Mr Kiran Patel </span><br/>
            <span>Email : summerfurnishings@yahoo.com</span><br/>
            <!-- <span>Website : </span><br/> -->
            <span>Contact No : 04 966 8375 / 012 476 7375</span><br/>
            <!-- <span>Working Hours : </span><br/> -->
          </p>
        </div>
      </li>
      
    </ul>
  </div>
  
  <div class="item" id="tab2">
    <h4 class="">Local Dealers</h4>
    <ul class="collapsible" data-collapsible="expandable"> 
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco offer any Discounts?
        </div>
        <div class="collapsible-body">
          <p>
            Yes we do. <br/>
            Details are in the file <a href="https://docs.google.com/spreadsheets/d/1IHMKqJmk26Ga2EXTp3oCUdjaI0RL5TGiclv7DLekbsI/edit?usp=sharing">PROMOTIONS AND DISCOUNT SCHEMES</a> on Google Drive in sheet OVERVIEW. <br/>
            *Note : Refer to the sheet Parameters to check under which category the enquiry falls. 
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Will there be any conflict of interest in pricing between dealer and principal?
        </div>
        <div class="collapsible-body">
          <p>
          Our website displays retail selling price. Dealers are recommended to follow the same price as minimum selling price.. For more info refer to www.horestco.com.my
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Do we keep stocks?
        </div>
        <div class="collapsible-body">
          <p>
          We keep stocks for fast moving items. Please refer to <a href="http://www.horestco.com.my">www.horestco.com.my</a> for stock availability or contact us prior to ordering.
          </p>
        </div>
      </li>
      <!-- <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide warranties on their products?
        </div>
        <div class="collapsible-body">
          <p>
          </p>
        </div>
      </li> -->
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide Transportation?
        </div>
        <div class="collapsible-body">
          <p>
          Transportation is to be arranged by the dealer. Skynet or any other courier service can also be used.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can Horestco Store items for Dealers?
        </div>
        <div class="collapsible-body">
          <p>
          Yes, maximum upto 3 months
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can Horestco deliver directly to the dealer’s customers?
        </div>
        <div class="collapsible-body">
          <p>
          Yes, It can be done. All costs to be billed to the Dealer.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco produce customized products?
        </div>
        <div class="collapsible-body">
          <p>
            No MOQ For Horestco Standard items, <br/>
            Yes,with MOQ for custom items. Chairs: 20 Nos, Tables: 5 Nos, Sofas : 5 Sets or Total order amount is RM 10,000.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Is Refund or return allowed?
        </div>
        <div class="collapsible-body">
          <p>
          Refund is not allowed however, exchange of goods can be made within one month from date of purchase subject to Horestco’s approval.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does Horestco provide Transit Insurance?
        </div>
        <div class="collapsible-body">
          <p>
          Products delivered through Skynet can be covered under Insurance provided by Skynet.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          What kind of support does Horestco provide to Dealers?
        </div>
        <div class="collapsible-body">
          <p>
          Providing High resolution photos and online marketing support.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Will Horestco provide After Sales Service?
        </div>
        <div class="collapsible-body">
          <p>
          No. After Sales Service is to be provided by Dealer.
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Payment Terms followed at Horestco?
        </div>
        <div class="collapsible-body">
          <p>
            <strong>For Non-Stock Items:</strong><br/>
            50% on order Confirmation<br/>
            50% before shipment (after Inspection of goods).
          </p>
          <p>
            <strong>For Stock Items:</strong> 100% on Order Confirmation
          </p>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Delivery Lead Time:
        </div>
        <div class="collapsible-body">
          <p>For Stock Items: 7-10 working days.</p>
          <p>For Non-Stock Items: (Follow below table)</p>
          <div class="row">
            <div class="col s12 m6">
              <table class="table bordered">
                <thead>
                  <tr>
                    <th>Material</th>
                    <th>Long</th>
                  </tr>
                </thead>
                <tr>
                  <td class="text-capitalize">CUSTOM WOODEN / MIX MATERIAL</td>
                  <td>10 Weeks</td>
                </tr>
                <tr>
                  <td class="text-capitalize">CUSTOM WICKER / METAL MATERIAL</td>
                  <td>10 Weeks</td>
                </tr>
                <tr>
                  <td class="text-capitalize">STANDARD WOODEN / MIX MATERIAL</td>
                  <td>8 Weeks</td>
                </tr>
                <tr>
                  <td class="text-capitalize">STANDARD WICKER / METAL MATERIAL</td>
                  <td>6 Weeks</td>
                </tr>
                <tr>
                  <td class="text-capitalize">STANDARD / CUSTOM CUSHIONS</td>
                  <td>4 Weeks</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </li>
    </ul>

    <h5 class="teal-text">Wicker:</h5>
    <ul class="collapsible" data-collapsible="expandable">
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Is your wicker material suitable for year-round outdoor use?
        </div>
        <div class="collapsible-body">
          <p>
          Yes. Our wicker material is designed to be insensitive to temperature differences ranging from -20° to 50° C.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Won’t the color of your wicker material fade?
        </div>
        <div class="collapsible-body">
          <p>
          No. our wicker material color won’t fade, even if it’s exposed to different weather conditions during summer and winter. It’s been proven in laboratory tests that our wicker material can withstand UV exposure for at least three years.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Is your wicker material safe for the environment?
        </div>
        <div class="collapsible-body">
          <p>
          Yes. our wicker material is made from polyethylene, which is non-toxic (even when burned, no toxic substances are generated) and 100% recyclable.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does your wicker material require special cleaning and maintenance?
        </div>
        <div class="collapsible-body">
          <p>
          No special maintenance is required. Simply clean using a wet cloth.<br/>
          An occasional cleaning using soap or a mild detergent is also recommended.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Does your wicker material offer a broad range of colors, shapes and textures?
        </div>
        <div class="collapsible-body">
          <p>
          Yes! Our wicker material offers many different choices for our customers.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can we put your wicker material outdoors for the whole year?
        </div>
        <div class="collapsible-body">
          <p>
          Yes, our wicker material is designed to be insensitive to temperature differences ranging from -20° to 50° C.
          </p>
        </div>
      </li>
    <li>
        <div class="collapsible-header">
          <i class="material-icons add">add</i>
          <i class="material-icons remove">remove</i>
          Can you share your material certifications and warranties? 
        </div>
        <div class="collapsible-body">
          <p>
            <a target="_blank" href="https://drive.google.com/drive/folders/10UDYnBAnLbA5iUvKhN-GxwpHBR_FElQ-?usp=sharing">https://drive.google.com/drive/folders/10UDYnBAnLbA5iUvKhN-GxwpHBR_FElQ-?usp=sharing</a>
          </p>
        </div>
      </li>
    </ul>
  </div>

</section>

<?php $this->load->view('template/default/script') ?>

<?php $this->load->view('template/default/footer') ?>

