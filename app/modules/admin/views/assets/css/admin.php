<style>
	header,
	main,
	footer{
		padding-left: 240px;
	}

	header nav{
		border-bottom: 1px solid #ddd;
	}

	#slide-out ul.collapsible li a{
		color: #fff;
	}
	#slide-out ul.collapsible li:hover,
	#slide-out ul.collapsible li:active{
		background: #565656;
	}

	@media only screen and (max-width : 992px) {
   header, main, footer {
     padding-left: 0;
   }
 }
	.progress{
		display: none;
	}
	.info-field{
		visibility: hidden;
		position: relative;
	}
	.input-field.error .info-field{
		visibility: visible;
	}
	.input-field.error .info-field:after{
		content: 'Not Available';
		position: absolute;
		top:0;
		bottom:0;
		right:0;
		left:0;
	}
	.input-field.error label,
	.input-field.error label.active,
	.input-field.error input{
		color: red !important;
	}
	.input-field.error input,
	.input-field.error input:focus{
		border-color: red;
	}

	.card.draggable{
		/*margin: 0;*/
	}
	.card.draggable:hover{
		/*cursor: move;*/
	}
	.card.draggable .card-content{
		padding: 0;
	}
	.card.draggable .row{
		margin-bottom: 15px;
	}

	.card-panel.card-panel-title{
		padding: 1px 20px;
		margin: -20px -20px 10px;
		border-radius: 2px 2px 0 0;
		background: #ddd;
	}

	.card-control ul{
		border-left: 1px dotted #ddd;
	}

	.editable .text{
		cursor: pointer;
	}
	.editable .text:hover{
		text-decoration: underline;
	}
	.btn-floating.fixed{
		position: fixed;
		top: 10px;
		right: 30px;
	}

	/* jqury-ui sortable */
	.ui-state-highlight{
		border: 1px dashed #ddd;
		background: #f9f9f9
	}

	.gap-5{
		margin: 0 5px;
	}
</style>