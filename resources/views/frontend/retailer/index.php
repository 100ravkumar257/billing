<?php include('header.php');?>
<style>
  .mt-20{
    margin-top:20px;
  }
  .modal-dialog {
    top: calc(100% - 550px); 
  }
  .owl-nav,.owl-dots{
    display: none;
  }
  .modal-header .close {
    padding: 1rem 1rem;
    margin: -1rem 0rem -1rem auto;
  }
  .btn2{
    width: 260px !important;
    height: 40px;
    border-radius:10px;
    background-color: #ffc107!important;
    margin-top: 380px;
    margin-left: 365px !important;
    border: none;
  }
  .btn3{
    width: 260px !important;
    height: 40px;
    border-radius:10px;
    background-color: #ffc107!important;
    margin-top: 380px;
    margin-left: 65px !important;
    border: none;
  }
  button.close {position: absolute;right: 0px;background: #fff;border-radius: 50%;width: 27px;height: 27px;}

.jbox-container{
  z-index: 989898!important;
}
  .event-gallery-area {
    background: #242424;
}
}
.event-gallery {
  overflow: hidden;
}
.event-gallery-imge {
  float: left;
  width: 20%;
  position: relative;
  overflow: hidden;
  transition: .4s;
  -webkit-transition: .4s;
}
.event-gallery-imge img {
  width: 100%;
  -webkit-filter: grayscale(100%);
  filter: grayscale(0%);
  transition: .3s;
}
.event-gallery-imge img:hover {
  width: 100%;
  -webkit-filter: grayscale(100%);
  filter: grayscale(0%);
  transition: .3s;
}
.jbox-img {
  cursor: pointer;
}
.presentation {
    background: #f1f1f1;
    padding: 10px 0 78px;
}
 .presentation h2 {
    text-align: center;
    font-size: 26px;
    margin: 45px 0;
    font-weight: bold;
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://www.indianchemicalnews.com/assets/virtual_assets//bootstrap.min.js"></script>


<main class="main">
  <section class="banner-tobb">
    <div class="full-with-wapper" style="height: 120px;"></div>
    <div class="full-with-wapper">
      <div class="over-video">
   <!--   <div class="bnr-btn">
          <a href="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-register" target="_blank" class="registk">Register Now</a>
          <a href="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-brochure-register" class="registk">Join As Partner</a>
        </div> -->

      </div>

      <a href="#" class="d-md-block  d-none"> <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/home_banner.png" alt="" class="img-gnes"></a>
      <a href="#" class="d-md-none"> <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/home_banner.png" alt="" class="img-gnes"></a>
      <div class="card-img-overlay d-none d-lg-block">

       <!--  <a href="https://www.indianchemicalnews.com/assets/virtual_assets/Nextgen-2023-show-guide.pdf" target="_blank"><button  type="button" class="btn2">Show Guide</button></a>

        <a href="https://www.indianchemicalnews.com/assets/virtual_assets/NextGen 2023 Report.pdf" target="_blank"><button  type="button" class="btn3">Download Post Show Report</button></a> -->

      </div>
    </div>

    <!--/.Carousel Wrapper-->
  </section>


  <section class="banner-mobile">
    <div class="banner">
      <!-- <h5 class="text-center"> Banner comming soon </h5> -->
      <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/mobile-banner.png">
    </div>
 <!--  <div class="banner-btns">
    <a href="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-register" class="registk">Register Now</a>
    <a href="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-brochure-register" class="registk">Join As Partner</a>
  </div> -->

</section>



<!-- Subscribe Modal -->
<div class="modal fade bg-subs" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="box-shadow: 0 0px 0px 0 rgb(245, 218, 194);">
     <button type="button" class="close close-load-popup" data-dismiss="modal" style="text-align: right;">×</button>
     <div class="modal-body load-popup-body" style="padding:unset;">
       <a href="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-register" target="_blank"><img src="https://www.indianchemicalnews.com/banner/NextGen-web-pop-up-banner.png?v=1.1"></a> 
     </div>         
   </div>
 </div>
</div> 

<?php  

$videodata = array(
  array('LtTDers5ZQ4', 'Presentation by Mr. Rahul Tikoo', 'Managing Director – South Asia', 'Huntsman Corporation'),
  array('ybSR2qFm7D4', 'Presentation by Mr. Pravin Prashant', 'Editor', 'Indian Chemical News'),  
  array('5Pfh42fRSLM', 'Panel Discussion', 'Net Zero and Decarbonisation Preparedness', ''),
  array('p9DlmRQOIEE', 'Panel Discussion', 'Digitalization: Driving Cost Optimisation & Operational Excellence', ''),
  array('C_1gIcxKTYc', 'Panel Discussion', 'Petrochemicals @2047: Towards A Self Reliant India', ''),
  array('MYvMXgqvrNo', 'Panel Discussion', 'Shift Towards Hydrogen Economy', ''),
  array('FZ5XPb3Vue0', 'Panel Discussion', 'Health, Safety, and Environment: The Missing Link', ''),
  array('psHyz3nxu4s', 'Panel Discussion', 'Battery: The Big Opportunity', ''),
  array('CdWulu5I0I8', 'Panel Discussion', 'R&D, Green Chemistry and Sustainability Goals', ''),
  array('k6onwNbBDT8', 'Panel Discussion', 'Specialty Chemicals: Driving the Growth', ''),
  array('oILZAhoOf50', 'Panel Discussion', 'Oil to Chemicals (O2C): Future of Refineries', ''),
  array('R99YNeoFP-Y', 'Mr. Ankur Singh', 'Vice President & Head Strategy,Chemicals Business', 'DCM Shriram Ltd'),
  array('5MchD4xuN1U', 'Dr. Hiten Mehta', 'Head R&D – Chlor Alkali', 'Aditya Birla Chemicals'),
  array('PXE-XMjYm5k', 'Panel Discussion', 'NextGen Leaders: The New Face of Manufacturing', ''),
  array('k_5ZcASCMbU', 'Panel Discussion', 'New Age Distribution: Challenges and Opportunities', ''),
  array('5w2g9gOx2K0', 'Panel Discussion', 'Bio-based Solutions for Energy and New Chemicals Transition', ''),
  array('K2G9mO-XI2o', 'Presentation by Mr. Sourav Ghosh', 'Head of Business Development – Chemicals & Pharmaceuticals', 'Siemens Ltd'),
  array('Cnz_c9s9vFQ', 'Presentation by Mr. Rohit Nagraj', 'Senior VP', 'Centrum Broking'),
  array('0ejOxjD8BKo', 'Presentation by Mr. Vivek Mohile', 'Technical Director', 'Automation & AI, Rieco Industries'),
  array('UKyD3hdl0KY', 'Presentation by Mr. Manoj Sharma', 'President & CHRO', 'Aarti Industries'),
  array('m1merPU5zw0', 'Presentation by Dr. Ritwik Kavathekar', 'Industry Process Consultant', 'Dassault Systemes BIOVIA'),
  array('bvNpf4RhTB', 'Presentation by Mr. Sachin Kulkarni', 'Head of Digital Enterprise for Process Industries', 'Siemens Ltd'),
  array('zk0Qh39YhGw', 'Presentation by Mr. Prashant Mishra', 'National Sales Manager', 'Premier Tech'),
  array('cqHRSVDmxbk', 'Vote of Thanks by Mr. Yogesh Joshi', 'Director', 'Indian Chemical News'),
  array('05ypcMJv37Y', 'Presentation by Mr. Sujeet Gohil', 'Vice President, Sales -Process Automation', 'Energy Industries, ABB India'),
  array('6O3FR3FWk_o', 'Presentation by Prof. Aniruddha B. Pandit', 'Vice Chancellor', 'ICT Mumbai'),
  array('B6ubpfXIyM4', 'Presentation by Dr. Pratap Nair', 'Founder, President & CEO', 'Ingenero Technologies'),
);

if(empty($videodata))  { ?>
  <section class="pont-waper">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="poin-hed">Event Videos</h1>
          <span class="about-border mx-auto"></span>
        </div>
      </div>
      <div class="owl-carousel owl-theme owl-loaded owl-drag">
        <div class="owl-stage-outer">
          <div class="owl-stage" style="transform: translate3d(-3025px, 0px, 0px); transition: all 0.25s ease 0s; width: 6050px;">
            <?php  
            foreach($videodata as $interview)
            {         
              $videoid = $interview[0];
              $title = $interview[1];
              $imgpath = "https://img.youtube.com/vi/$videoid/mqdefault.jpg";
              $video_url = "https://youtu.be/".$videoid;
              $slug    =  $video_url;
              ?>
              <div class="owl-item " style="width: 292.5px; margin-right: 10px;">
                <div class="item">
                  <div class="wap-pons" style="height: auto;border-radius: 0px;padding:5px;">
                    <a class="view-interview" data-toggle="modal" data-target="#interviewModal"  href="javascript:void(0);" data-src="<?php echo $videoid;?>" data-href="<?=$video_url ?>" ><img src="<?php echo $imgpath?>" alt="<?php echo $title?>"  class="img-fluid video-large"></a>

                  </div>
                </div>
              </div>
              <?php 
            } 
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" id="interviewModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body dynamic-content" style="padding:0px;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:2px;">
            <span aria-hidden="true">&times;</span>
          </button>
          <iframe id="interviewSrc" width="100%" height="450" src="" frameborder="0"   allowfullscreen> </iframe>
        </div>

      </div>
    </div>
  </div>

  <script>
    $(".view-interview").click(function(){
      let src = $(this).attr('data-src');
      $("#interviewSrc").attr("src",`https://www.youtube.com/embed/${src}`);
    });


    $('.view-interviewwww').on('click',function(event) {
      event.preventDefault();
      let href= $(this).attr('data-href');
      $('.dynamic-content').load(href,function(){
        $('#interviewModal').modal({show:true});
      });
    });


    $('#interviewModal').on('hidden.bs.modal', function(e) {
      $('iframe').attr('src', $('iframe').attr('src'));
    }); 


    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:false,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:3
        },
        1000:{
          items:4
        }
      }
    })


  </script>
<?php }  ?>

<?php //if($_SERVER['REMOTE_ADDR'] == '110.227.191.132' && 1) { ?>
<div class="presentation d-none" id="presentation">
  <div class="container">
    <h2>Presentation</h2>

    <div class="owl-carousel owl-theme">

    <div class="item">
      <a href="imgs/pdf/2030_Navigating Strategies for Skilled Manpower Readiness_12July2024 Dr. Achala Danait.pdf" target="_blank"><img src="imgs/pdf/2030_Navigating-Strategies-for-Skilled-Manpower-Readiness_12July2024-Dr.jpg"></a>
    </div>

    <div class="item">
      <a href="imgs/pdf/Bhavna Bindra_Lubrizol.pdf" target="_blank"><img src="imgs/pdf/Bhavna-Bindra_Lubrizol-1.jpg"></a>
    </div>

   <div class="item">
      <a href="imgs/pdf/B-Narayan_Reliance-Industries-1.pdf" target="_blank"><img src="imgs/pdf/B-Narayan_Reliance-Industries-1.jpg"></a>
    </div>


     <div class="item">
      <a href="imgs/pdf/Cadmatic-eShare-OO-NEXTGEN2024 Final.pdf" target="_blank"><img src="imgs/pdf/Cadmatic-eShare-OO-NEXTGEN2024-Final-1.jpg"></a>
    </div>

    <div class="item">
      <a href="imgs/pdf/Daljit Singh - Next Gen - Chemicals and Petrochemicals 2024.pdf" target="_blank"><img src="imgs/pdf/Daljit-Singh---Next-Gen---Chemicals-and-Petrochemicals-2024-1.jpg"></a>
    </div>

   <div class="item">
      <a href="imgs/pdf/Future of Petrochemicals - NextGen.pdf" target="_blank"><img src="imgs/pdf/Future-of-Petrochemicals---NextGen-1.jpg"></a>
    </div>

     <div class="item">
      <a href="imgs/pdf/Ganeshan S_UPL.pdf" target="_blank"><img src="imgs/pdf/Ganeshan-S_UPL-1.jpg"></a>
    </div>

    <div class="item">
      <a href="imgs/pdf/ICN- Alok Sharman-12 July 2024.pdf" target="_blank"><img src="imgs/pdf/ICN--Alok-Sharman-12-July-2024-1.jpg"></a>
    </div>

   <div class="item">
      <a href="imgs/pdf/Ingenero Presentation-ICN July 2024-vf.pdf" target="_blank"><img src="imgs/pdf/Ingenero-Presentation-ICN-July-2024-vf-1.jpg"></a>
    </div>

     <div class="item">
      <a href="imgs/pdf/Next Gen Chemicals.pdf" target="_blank"><img src="imgs/pdf/Next-Gen-Chemicals-1.jpg"></a>
    </div>

    <div class="item">
      <a href="imgs/pdf/NextGen Presentation JaajiTech 11th July.pdf" target="_blank"><img src="imgs/pdf/NextGen-Presentation-JaajiTech-11th-July-1.jpg"></a>
    </div>

   <div class="item">
      <a href="imgs/pdf/NGN 2024 PPT 0841.pdf" target="_blank"><img src="imgs/pdf/NGN-2024-PPT-0841-1.jpg"></a>
    </div>

     <div class="item">
      <a href="imgs/pdf/Plastics Recycling _ Recovery - 9X5.5 Feet.pdf" target="_blank"><img src="imgs/pdf/Plastics Recycling _ Recovery - 9X5.5 Feet-pdf.jpg"></a>
    </div>

    <div class="item">
      <a href="imgs/pdf/Presentation_GIP-Mr. Manikanth.pdf" target="_blank"><img src="imgs/pdf/Presentation_GIP-Mr.jpg"></a>
    </div>

   <div class="item">
      <a href="imgs/pdf/SOLIDIFICATION with Steel belt Cooling System Technology.pdf" target="_blank"><img src="imgs/pdf/SOLIDIFICATION-with-Steel-belt-Cooling-System-Technology-1.jpg"></a>
    </div>

</div>
  </div>
</div>
<div class="text-center py-3 mt-3 d-none">
  <h2>Event Snapshots</h2>    
</div>
<section class="event-gallery-area d-none" style="margin-bottom:30px;">  
  <div class="event-gallery">
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/1.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/2.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/3.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/4.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/5.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/6.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/7.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/8.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/9.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/10.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/11.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/12.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/13.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/14.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/15.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/16.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/17.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/18.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/19.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/20.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/21.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/22.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/23.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/24.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>
    <div class="event-gallery-imge">
      <a>
        <img src="imgs/nextgen_snapshots/25.jpg" alt="" class="img-responsive jbox-img">
        <div class="gallery-title"></div>
      </a>
    </div>

  </div>
</section>
<?php //} ?>


<section class="about-sec-home home-tow-wap ">
  <div class="container">
    <div class="row" style="padding-top:30px !important;">
      <div class="col-lg-4">
        <div class="row no-gutters">
          <div class="col-md-6">
           <div class="img-about-wapper">
             <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/ab-1.jpg" alt="">
           </div>
         </div>
         <div class="col-md-6">
           <div class="img-about-wapper">
             <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/ab-3.jpg" alt="">
           </div>
         </div>
       </div>
       <div class="row no-gutters">
        <div class="col-md-6">
         <div class="img-about-wapper">
          <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/ab-4.jpg" alt="">
        </div>
      </div>
      <div class="col-md-6">
       <div class="img-about-wapper">
        <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/ab-2.jpg" alt="">
      </div>
    </div>
  </div>
</div>

<div class="col-lg-8 mx-auto">
  <div class="about-wapperhome">
    <div class="heading-bow">
      <h1 class="text-md-left">Introduction</h1>
      <span class="about-border"></span>
    </div>
<p class="lis-ab">The Indian chemicals industry is a dynamic and growing sector, adding around 7% to India's GDP and
contributes around 15% to manufacturing output. The sector is expected to reach US $1 Trillion by 2040,
fuelled by the rising demand from various end-use sectors such as pharmaceuticals, agrochemicals,
FMCG, automobiles, textiles, paints, and plastics. The Indian Chemicals and Petrochemicals industry
has to play a key role if India needs to achieve its ambitious US $10 trillion economy goal by 2030.
</p>
<p class="lis-ab">Supporting India’s vision to become self-reliant in chemicals and petrochemicals sectors, Indian
Chemical News, the most credible digital media platform for Chemicals, Petrochemicals, and Energy
sectors, brings the Fifth Edition of ‘The most sought-after calendar event of the year,’ for the industry:
The NextGen Chemicals & Petrochemicals Summit 2025. The theme of this year’s summit is “Preparing
for Future Growth.” The event is scheduled on June 18-19, 2025 at The Leela, Mumbai.</p>

<p class="lis-ab">One of the premier Indian chemicals events of the year, NextGen Chemicals & Petrochemicals Summit,
showcases a stellar lineup of chemical leaders and experts sharing insights, success stories and
formulas for successes in order to prepare the industry to achieve its desired goal. </p>

<p class="lis-ab">The NextGen Chemicals & Petrochemicals Summit is an ultimate learning experience of industry’s best
practices, unrivalled ideas, motivation, resolve, and much more.
</p>

<p class="lis-ab">The Summit will be an industry driven deliberation that will endeavour to bring out the most meaningful 
and business enabling dialogue and help develop a comprehensive reviewof India’s Chemicals & Petrochemicals sectors.  
Topics covered at the Summit include Market Trends, Specialty Chemicals, Petrochemicals, Advanced Materials,
Flavours & Fragrances, Crop Nutrition, Digital Transformation,
Alternative Feedstocks, Energy Transition, Green Chemicals, Investments, Mergers & Acquisitions, Battery,
Research & Development, Green Hydrogen, Construction Chemicals, and Sustainability amongst others. 
</p>

<p class="lis-ab">The two-day summit will cover various panel discussions, presentations, fireside chat, and Expo to provide  
a focused and comprehensive scenario of the industry. It will alsoprovide opportunities for the delegates to exchange ideas,
network, and establish business or research relations anpotential partners for future collaboration.
</p>


  </div>  
</div>

</div>

</div>
</section>
<!-- over view -->




<!-- section quick facts end -->
<section class="wap-over" id="overview">
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <div class="over-viee">
          <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/cots.png" alt="" class="img-fals">
          <h1 class="hed-wpa">
            Overview  
          </h1>
        </div>
      </div>
      <div class="col-lg-10">
        <div class="wap-info-over">
          <p class="wap-info-oer">The Indian chemical industry has a broad portfolio and this diversity allows it to cater to various globalmarkets and sectors. The market is growing due to urbanization, industrialization, and rising
          consumption, providing a stable base for production and fosters economies of scale. India is in an
          advantageous position due to access to a relatively low-cost labour force and a range of native raw
          materials, contributing to competitive pricing in certain segments, particularly in Basic and Specialty
          Chemicals. Moreover, Government's policies such as Make in India, Atmanirbhar Bharat, Chemical Policy,
          PCPIR and export incentives bolster the growth of
          the chemical sector. 
           <br><br>

          However, the Indian chemical industry has also been facing various challenges that hinders growth.
          The industry faces stiff competition from established markets such as China, Europe, and the
          US, which have advanced technologies and higherproduction capacities.
           <br><br>
          While infrastructure improvements are underway, challenges related to transportation, logistics, and
          energy supply are affecting eciency and cost competitiveness. Hence, building resilient
          supply chains and improving logistics infrastructure can enhance operational
          eciency and lower costs.
 
           <br><br>
          Sustainability is another important issue where India needs toup it s ante. 
          As g loba l standards for environmental sus t a inabi l it y become stricter, Indian companies
          may face challenges in meeting these regulations. Embracing sustainable practices and green chemistry
          will position Indian companies as responsible suppliers in the global marketplace. Also, increasing 
          investment in R&D can lead to innovation, allowing Indian companies to
          move up the value chain and improve product offerings.

           <br><br> 
           Moreover, investing in digital technologies can optimize production processes, minimize costs, and
          enhance customer interaction, ultimately improving competitiveness. Also, collaborating with global
          firms and leveraging foreign direct investment can bring in advanced technologies and expertise,
          enhancing competitiveness.

           <br><br>
           Overall, the Indian chemical industry possesses multiple strengths that position it favorably in the global
            market. By addressing existing challenges, investing in innovation, and focusing on sustainable
            practices, it can further enhance its competitiveness and expand its global market share.
   
         </p>
       </div>
     </div>
   </div>
 </div>
</section>
<!-- key dis -->
<section class="pont-waper">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="poin-hed">KEY DISCUSSION TOPICS</h1>
        <span class="about-border mx-auto"></span>
      </div>
    </div>
    <div class="owl-carousel owl-theme">
      <div class="item">
        <div class="wap-pons">
          <h3>Market Trends, Competitive Analysis and India Opportunities</h3>
          <div class="bod-te"></div>
        </div>
      </div>
      <div class="item">
        <div class="wap-pons">
          <h3>Digital Transformation: Adoption of Industry 4.0 in Chemicals & Petrochemicals </h3>
          <div class="bod-te"></div>
        </div>
      </div>
      <div class="item">
        <div class="wap-pons">
          <h3>
            Alternative Feedstocks: Bio-based and Waste-derived for Chemical Production
          </h3>
          <div class="bod-te"></div>
        </div> 
      </div>
      <div class="item">
        <div class="wap-pons">
          <h3>
           Advanced Materials: Development of New Materials and its Applications
         </h3>
         <div class="bod-te"></div>
       </div>
     </div>
     <div class="item">
       <div class="wap-pons">
        <h3>
         Petrochemicals: A Big Opportunity for India?
       </h3>
       <div class="bod-te"></div>
     </div>
   </div>
   <div class="item">
     <div class="wap-pons">
      <h3>
       Sustainability, Green Chemicals and Circular Economy
      </h3>
      <div class="bod-te"></div>
    </div>
  </div>
  <div class="item">
   <div class="wap-pons">
    <h3>
      Inviting Investments/M&A in Chemicals & Petrochemicals 

    </h3>
    <div class="bod-te"></div>
  </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Battery: Preparing for the Next Wave 
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
      Crop Nutrition: Maximising Productivity 
    </h3>
    <div class="bod-te"></div>
  </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Innovations in R&D for Chemicals and Petrochemicals
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Accelerating Green Hydrogen Mission: From Vision to Execution
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Specialty Chemicals: Fuelling Growth
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Construction Chemicals: Carving a Niche
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
<div class="item">
  <div class="wap-pons">
    <h3>
     Flavours & Fragrances: Time for Value Addition
   </h3>
   <div class="bod-te"></div>
 </div>
</div>
</div>
</div>
</section>

<?php//if($_SERVER['REMOTE_ADDR'] == '110.227.191.132' && 1) { ?>
  <section class='pb-3 d-none' style="background:#efecec; width:100%;">
<div class="container ">
  <div class="row">
    <div class="col-md-12">
        <div class="text-center py-3 mt-3">

          <a href="https://www.indianchemicalnews.com/assets/white_paper/Digital-Sustenance-Service-Forbes_Marshall.pdf" download>
            <img src="https://www.indianchemicalnews.com/assets/white_paper/white-paper.jpg" class="img-responsive">
        </a>    
       </div>      
    </div>
  </div>
</div>
</section>
<?php //} ?> 

<?php  if(!empty($eventArray['speakers'])){ ?>
  <section class="speakers " id="speakers">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="poin-hed">Speakers</h1>
          <span class="about-border mx-auto"></span>
        </div>
      </div>

      <!--    <h5 class="text-center">comming soon</h5> -->
      <div class="row">


        <?php foreach ($eventArray['speakers'] as $key => $speaker) { 
          if($key==99999){ ?>
           <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="wap-speakers">
              <h3>Chief Guest</h3>
              <div class="imag-spaea">
                <img src="https://www.indianchemicalnews.com/public/uploads/panelist/<?=$speaker['image'];?>" alt="<?=$speaker['name'];?>" class="spaker speaker_tab" data-speaker="<?=$speaker['id'];?>">
              </div>
              <div class="wap-ing speaker_tab">
                <h5> <?=$speaker['name'];?></h5>
                <div class="tid"></div>
                <p class="wap-idn"><?= $speaker['designation']; ?><br><?=$speaker['company_name'];?></p>
              </div>
            </div>
          </div>

          <?php	

        } else {


          ?>

          <div class="col-lg-3 col-md-6">
           <div class="wap-speakers">
            <div class="imag-spaea">
              <img src="https://www.indianchemicalnews.com/public/uploads/panelist/<?=$speaker['image'];?>" alt="<?=$speaker['name'];?>" class="spaker speaker_tab cursor-pointer" data-speaker="<?=$speaker['id'];?>">
            </div>
            <div class="wap-ing speaker_tab">
              <h5><?=$speaker['name'];?></h5>
              <div class="tid"></div>
              <p class="wap-idn "><?= $speaker['designation']; ?><br>
               <?=$speaker['company_name'];?></p>
             </div>
           </div>
         </div>

         <?php
       }
     } 

     ?>
   </div> 
 </div>
</section>
<?php }?>
<?php if(!empty($eventArray['sponsers'])){ ?>
  <section class="partner-wapd" id="partners">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="poin-hed">Partners</h1>
          <span class="about-border mx-auto"></span>
        </div>
      </div>
      <?php foreach ($eventArray['sponsers'] as $type => $sponsers) { ?>
        <div class="row">
          <div class="col-lg-12">
           <!-- <h5 class="text-center">comming soon</h5> -->
           <div class="wap-partners">
             <?php if(!empty($sponsers)){ 

              $countPartners = count($sponsers);
              if($countPartners==1){


                $type = rtrim($type, "s");
              }
              ?>
              <div class="gold-p  mb-2">
                <span class="par"><?=$type;?></span>
              </div>
              <div class="wap-part-wbo mb-4">

               <?php  foreach ($sponsers as $sponser_data) { ?>
                <div class="gold-lod">
                 <a href="<?=$sponser_data['link'];?>" target="_blank"> <img src="<?=$sponser_data['image_url'];?>" alt="<?=$sponser_data['company_name'];?>" class="gold-imgj"></a>
               </div>
             <?php } ?>
             
           </div>
         <?php }?>
       </div> 

       
     </div>
   </div>
 <?php } ?>

 <div class="wap-part-wbo">
  <div class="gold-lod">
    <span class="par">Event Tech Partner  </span>
    <a href="https://www.ezbizsoft.com/" target="_blank"><img src="https://www.indianchemicalnews.com/assets/virtual_assets/img/ezbiz-black-logo.png" alt="" class="gold-imgezd"></a>
  </div>
  <div class="gold-lod">
    <span class="par">MEDIA PARTNER</span>
    <a href="https://www.indianpharmapost.com/" target="_blank"><img src="https://www.indianchemicalnews.com/assets/virtual_assets/img/Indian-pharma-post.png" alt="" class="gold-img"></a>
  </div>
  <div class="gold-lod">
    <span class="par">AN INITIATIVE BY </span>
    <a href="https://www.indianchemicalnews.com/" target="_blank"><img src="https://www.indianchemicalnews.com/assets/virtual_assets/img/icn.png" alt="" class="gold-img"></a>
  </div>
</div> 
</div>
</div>
</section>
<?php }?>

<section class="confer-wapper d-none" id="agenda">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto ">
        <h1 class="wap-bs text-center"> Conference Agenda<sup><small>*</small></sup></h1>
        <span class="about-border mx-auto"></span>
      </div>
    </div>
    <!-- <h5 class="text-center">comming soon</h5> -->
    <div class="row mt-md-4">
      <div class="col-lg-3 col-md-4">
        <div class="wao-cond">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link pisl-box active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">July 11, 2024 </a>
            <a class="nav-link pisl-box" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">July 12, 2024 </a>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-8">
        <div class="wap-confersc">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="wap-sation">
                <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/NGN-2024-day-1.jpg?v=<?php echo time();?>" class="img-fluid" alt="">
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="wap-sation">
               <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/NGN-2024-day-2.jpg?v=<?php echo time();?>" class="img-fluid" alt="">
               <p style="text-align:left; margin-left:20px;" class="pr-22"> *Subject to Change</p>
             </div>
           </div>
           
         </div>
       </div>
     </div>
   </div>
 </div>
</section> 




<section class="wap-bos-sectors">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="wap-bs text-center">SECTORS COVERED</h1>
        <span class="about-border mx-auto"></span>
      </div>
    </div>
    <div class="row sectors-text">
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Basic Chemicals</h5>
        </div>
      </div>

      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Organic Chemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Inorganic Chemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Specialty Chemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Agrochemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Alkali Chemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Clean and Green Chemicals</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Hydrogen</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Bio-based Energy 
          </h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>EV & Battery</h5>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wap-listing">
          <h5>Dyes & Dye Stuffs
        </h5>
        </div>
      </div>
       <div class="col-md-2">
        <div class="wap-listing">
          <h5>Dye Intermediates 
        </h5>
        </div>
      </div>
    </div>
    <div class="row sectors-text">
        <div class="col-md-2 col-xs-2">
        <div class="wap-listing">
          <h5>Pigments</h5>
        </div>
      </div>

       <div class="col-md-2 col-xs-2 ">
      <div class="wap-listing">
        <h5>Polymers</h5>
      </div>
    </div>

     <div class="col-md-2 col-xs-2 ">
      <div class="wap-listing">
        <h5>Aromatics</h5>
      </div>
    </div>
    <div class="col-md-2 col-xs-2">
      <div class="wap-listing">
        <h5>Plastics</h5>
      </div>
    </div> 
    <div class="col-md-2 col-xs-2">
      <div class="wap-listing">
        <h5>Petrochemicals</h5>
      </div>
    </div>
      <div class="col-md-2 col-xs-2">
      <div class="wap-listing">
        <h5>Gas</h5>
      </div>
    </div>   

    <div class="col-md-2 col-xs-2">
      <div class="wap-listing">
        <h5>ESG/HSE</h5>
      </div>
    </div>  
  </div>


</div>
</section>



<section class="wap-box-re">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="wap-bs text-center">Reasons to Participate</h1>
        <span class="about-border bg-white mx-auto"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <ul class="cond-rd">
          <li>
            <div class="wap-atten-ing">
              <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> A well curated agenda focusing on opportunities,
              challenges and global trends</p>
            </div>
          </li>
          <li>
            <div class="wap-atten-ing">
              <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> A platform providing great networking opportunities
              with industry experts and solution providers</p>
            </div>
          </li>
          <li>
            <div class="wap-atten-ing">
              <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> Branding Opportunities throughout the platform</p>
            </div>
          </li> 

        </ul>
      </div>
      <div class="col-md-6 wap-section-second">
        <ul class="cond-rd">

         <li>
          <div class="wap-atten-ing">
            <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> Gain insights from who’s who of chemical and petrochemical industry</p>
          </div>
        </li> 

        <li>
          <div class="wap-atten-ing">
            <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> Explore innovative products & solutions from the top
            industry players</p>
          </div>
        </li>
        <li>
          <div class="wap-atten-ing">
            <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> Develop new & strengthen existing relations with
            business partners and suppliers</p>
          </div>
        </li>
          <li>
            <div class="wap-atten-ing">
              <p><i class="fas fa-long-arrow-alt-right box-rw-righr"></i> Network with key decision makers under one roof
              </p>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
  
</section>



<!-- section why should attend -->

<section class="wap-bos-sectorsw" id="attedn">
  <div class="container">
    <div class="col-lg-9 mx-auto">
      <h1 class="wap-bs text-center">Who Should Attend</h1>
      <span class="about-border mx-auto bg-white mb-5"></span>
    </div>
    <div class="row p-0">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-4 col-sm-6 p-1">
            <ul class="list-swhsy">
              <li> <p class="wap-tes">Policy Makers/Decision Makers</p></li>
              <li> <p class="wap-tes"> CMDs/CEOs/MDs </p></li>
              <li> <p class="wap-tes">Academia</p></li>
              <li> <p class="wap-tes">IT &amp; Technology Managers</p></li>
              <li> <p class="wap-tes">Plant Managers &amp; Operators</p></li>

            </ul>
          </div>
          <div class="col-md-4 col-sm-6 p-1">
            <ul class="list-swhsy">
             <li> <p class="wap-tes">Automation Head/Manager</p></li>
             <!-- <li> <p class="wap-tes">Industrial Automation Managers</p></li> -->
             <li> <p class="wap-tes">Sales & Marketing Head</p></li>
             
             <li> <p class="wap-tes">EPC solution providers</p></li>
             <li> <p class="wap-tes">Quality Heads &amp; Professionals</p></li>
             <li> <p class="wap-tes">Production Head</p></li>


           </ul>
         </div>
         <div class="col-md-4 col-sm-6 p-1">
          <ul class="list-swhsy">
            <li> <p class="wap-tes">Think Tank</p></li> 
            <li> <p class="wap-tes">Financial Institutions</p></li> 
            <li> <p class="wap-tes">Industry Associations</p></li>
            <li> <p class="wap-tes">Senior Executives</p></li> 
            <li> <p class="wap-tes">Experts/Consultants</p></li> 

          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="wap-img-end">
        <div id="slide-wy" class="carousel slide" data-ride="carousel" data-interval="500">
         <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100 img-fluid" src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/Chem13.png" alt="First slide">
          </div>
          <div class="carousel-item ">
            <img class="d-block w-100 img-fluid" src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/Chem12.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 img-fluid" src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/Chem11.png" alt="Third slide">
          </div>
          <div class="carousel-item ">
            <img class="d-block w-100 img-fluid" src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/Chem10.png" alt="Second slide">
          </div>
          
        </div>
        <a class="carousel-control-prev" href="#slide-wy" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slide-wy" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</section>
<!-- conferedne -->


<!-- section faq's -->
<section class="faq-waper d-none" id="faqs">
  <div class="contianer">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="wap-bs text-center">FAQ's</h1>
        <span class="about-border mx-auto"></span>
        <div class="wa-faq">
          <div id="main">
            <div class="container">
              <div class="accordion" id="faq">
                <div class="card">
                  <div class="card-header" id="faqhead1">
                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">VIRTUAL BOOTH CUSTOMIZATION?</a>
                  </div>

                  <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                    <div class="card-body">
                      Virtual Booths can be customized and options
                      can be given to the sponsors from templates
                      that are available with the platform or the
                      Sponsors can create their own designs and
                      submit it to us in the sizes given by us and we
                      can create the environment
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead2">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">HOW MANY TEAM MEMBERS REQUIRED?</a>
                  </div>

                  <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                    <div class="card-body">
                      We can expect 4 to 5 members from each
                      sponsor to manage the backend work for virtual booth and conference.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead3">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3">WHAT IS THE ROLE OF PERSON HANDLING
                      VIRTUAL BOOTHS? 
                    </a>
                  </div>

                  <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                    <div class="card-body">
                      The team members will have to manage the
                      Chat/Virtual booth. Attendees can chat with you
                      or do a Video call to interact. The Booth
                      managers need to multi task to interact with
                      more number of people at any given time. 
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead4">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4">HOW WILL THE MARKETING BE DONE?
                    </a>
                  </div>

                  <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                    <div class="card-body">
                      Submit will be extensively promoted via email
                      marketing, sms, online ads, social media
                      promotion and trade magazine publications.

                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead5">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq5">HOW WILL THE SPEAKERS PRESENT THE
                      WEBINAR? DO THEY NEED TO BE PRESENT
                    ANYWHERE PHYSICALLY? </a>
                  </div>

                  <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                    <div class="card-body">
                      Speakers can join webinars via Webcast from
                      their respective offices, they need to have good internet
                      connection, Conference room for noise free
                      environment and landline phone to join the
                      Phone bridge. The Webinar will be broadcasted
                      through the virtual platform. 
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead6">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq6" aria-expanded="true" aria-controls="faq6">DO THE ATTENDEES HAVE TO DOWNLOAD
                    WEBINAR SOFTWARE? IS IT MOBILE COMPATIBLE?</a>
                  </div>

                  <div id="faq6" class="collapse" aria-labelledby="faqhead6" data-parent="#faq">
                    <div class="card-body">
                      Not needed, they can join from a link that is
                      sent to them post the Registration. Also, the
                      Virtual Platform is mobile compatible and the
                      attendees can join from any devices.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="faqhead7">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq7" aria-expanded="true" aria-controls="faq7">WHAT ARE THE TOOLS AVAILABLE TO
                    CONNECT WITH VIRTUAL VISITORS?</a>
                  </div>

                  <div id="faq7" class="collapse" aria-labelledby="faqhead7" data-parent="#faq">
                    <div class="card-body">
                      You can use chat, video calling, and other interactive networking
                      options to connect with visitors and sponsors at the virtual platform.

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="events-box">
  <div class="container">
   <div class="row">
     <div class="col-md-6">
      <div class="images-bos">
        <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/speaker.jpg" alt="" class="bos"> 
      </div>
    </div>
    <div class="col-md-6">
      <div class="encet-wap">
        <h4 class="hed0-s">
          CONFERENCE
          <span class="coldo"> SPEAKERS</span> 
        </h4>
        <p class="wap-edn">
         The profile of the speaker faculty is always
         critical to engage qualitative and
         quantitative delegate participation. As
         such, we take utmost care to address
         pressing issues and design a sharp
         conference module that would capture
         attention of knowledgeable, experienced
         and well informed industry experts. 
       </p>
     </div>
   </div>
 </div>
 <div class="row mt-3">
  <div class="col-md-6 order-md-1">
   <div class="images-bos">
     <img src="https://www.indianchemicalnews.com/assets/virtual_assets/2022/promotion.jpg" alt="" class="bos"> 
   </div>
 </div>
 <div class="col-md-6">
  <div class="encet-wap">
    <h4 class="hed0-s">
      EVENT & AUDIENCE
      <span class="coldo">  PROMOTION</span>
    </h4>
    <p class="wap-edn">
     With the combination of ICN editorial
     cum research based approach and
     excellent connect with senior level
     industry stakeholders, we are poised to
     further expand our reach with NextGen
     Chemicals & Petrochemicals Summit
     2024. The upcoming summit will be
     driven by a unique audience prequalification process and shall be
     promoted extensively both via oine
     and digital outreach platforms. 
   </p>
 </div>
</div>
</div>
</div>
</section>


<section class="org-wapper d-none">
  <div class="container">
    <div class="row">

    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="wapp-bos">
          <h1 class="org-by">Organized By</h1>
          <span class="about-border-2"></span>
        </div>
      </div>
      <div class="col-md-8">
        <div class="wap-orns-fon">

          <p class="wap-fond-">
           Indian Chemical News is an important online resource for news, views, analysis, trends,technology updates and interviews with prominent leaders in the Chemicals,
           Petrochemicals, and Energy sector. Our aim is to provide independent,uthoritative, and interactive Chemicals, Petrochemicals, and Energy information, enabling our readers to make better-informed business and planning decisions. Our mission is to be India's most credible information portal for the Chemicals, Petrochemicals, and Energy industries. The online news portal has been actively covering the Chemicals and Petrochemicals sector since 2008.<br>
           For more information, please visit www.indianchemicalnews.com 
         </p>
       </div>
     </div> 
   </div>
 </div>
</section>

<?php /*
<section class="speakers  past_partners" id="past_partners">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="poin-hed">Past Partners</h1>
        <span class="about-border mx-auto"></span>
      </div>
        <div class="col-md-12">
          <img src="https://www.indianchemicalnews.com/nextgen-chemical-and-petrochemical-summit-2024/imgs/Promo_NextGen-Chemicals-Past-Partners.png" class="img-responsive">
        </div>
    </div>
  </div>
</section>
*/ ?>

<!--  -->
<!-- Modal SPEAKER -->
<div class="modal fade" id="speaker_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999999;">
  <div class="modal-dialog modal-lg modal-dialog-top">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Speaker</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right:10px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--END  Modal -->
<script type="text/javascript"> 
  $('.speaker_tab').click(function(){
    speaker_id = $(this).data('speaker');
    furl = 'https://www.indianchemicalnews.com/webinar/getSpeakers/'+speaker_id;
    
    $('#speaker_model').find('.modal-body').load(furl);
    $('#speaker_model').modal('show');
  });
  
</script>
<!--  -->
<?php include('footer.php');?>