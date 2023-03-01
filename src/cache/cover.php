<style>
    .cover {
        text-align: center;
        width: 100%;
        background: #000;
        overflow: hidden;
        margin-top: -30px;
    }

    @media (max-width: 1023px) {
        .cover {
            height: 400px !important;
        }
    }

    .cover__item {
        position: relative;
    }

    .cover__bg {

    }

    .cover__images {
        position: relative;
        display: inline-block;
        height: 500px;
    }

    .cover__images:before, .cover__images:after {
        content: "";
        top: 0;
        position: absolute;
        height: 100%;
        z-index: 2;
    }
    .cover__images:before {
        left: 0;
        background: linear-gradient(to right,#000 0,rgba(0,0,0,0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6000000', endColorstr='#00000000', GradientType=1);
        width: 40%;
    }
    .cover__images:after {
        right: 0;
        background: linear-gradient(to right,rgba(0,0,0,0) 0,#000 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#a6000000', GradientType=1);
        width: 40%;
    }
    @media (max-width: 1040px) and (min-width: 580px) {
        .cover__images:before {
            width: 20%;
        }
    }
    @media (max-width: 1023px) {
        .cover__images {
            height: 400px !important;
        }
    }

    .cover__images img {
        display: inline-block;
        height: 100%;
        max-width: 100%;
        width: 1500px;
        object-fit: cover;
    }
</style>
<div id="cover" class="cover cover-single">
	<div class="cover__item">
		<div class="cover__bg">
    		<span class="cover__images">
        		<img src="http://gridlove/wp-content/themes/gridlove/assets/img/gridlove_default.jpg"
		             alt="Привет, мир!">
        	</span>
		</div>
	</div>
</div>
