<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
   
</head>

<style>
    :root {
  --primary-color: #523680;
  --Secondary-color: #ff783e;
  --logo-color: #523680;
}


@page{
  size:A4 landscape;
  margin:10mm;
 }
 .border-pattern{
  border:1mm solid var(--primary-color);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.199);
 
 }
 .content{
  border:1mm solid var(--logo-color);
  background:white;
 }
 .inner-content{
  border:1mm solid var(--logo-color);
  margin:2mm;
  padding:4mm;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
 }
 .inner-content h1{
  font-size: 3rem;
  text-transform:uppercase;
 color: var(--Secondary-color);
 }
 .inner-content h3 ,p {
  width: 60%;
 }
 .inner-content h3{
  padding-bottom:1mm;
  border-bottom:3px solid var(--Secondary-color);
 }
 .inner-content h5{
  text-transform:uppercase;
  padding-bottom:1mm;
  color: black !important;
  display:inline-block;
  border-bottom:1mm solid var(--Secondary-color);
 }
 .inner-content p {
  font-size: 17px;
  color: black !important;
 }
 .badge img{
   width:15rem;
   height:4rem;
margin-left: 2rem;
 }

 @media(max-width:767px){
  .inner-content h1{
    font-size: 2rem;
   }
  .badge img{
 margin-left: 0rem;
  }
  .inner-content p {
    font-size: 15px;
   }
   .inner-content h3 ,p {
    width: 100%;
   }
}















/* HEADER SECTION ///////////////////// */
/* Header */
.main-logo-div{
  width:9rem  !important;
}  
.main-logo{

  width: 100%;
}
header {
  background-color: #fff;
  padding: 10px 0;
}
header .navbar-brand {
  text-transform: uppercase;
  letter-spacing: 0.2em;
  font-weight: 800;
  font-size: 2rem;
}
header .navbar-brand.absolute {
  position: absolute;
}
@media (max-width: 991.98px) {
  header .navbar-brand.absolute {
    position: relative;
  }
}
header .navbar-brand span {
  color: #fff;
}
@media (min-width: 768px) {
  header .navbar-brand span {
    color: #ced4da;
  }
}
header .navbar {
  background: #fff !important;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
@media (min-width: 768px) {
  header .navbar {
    padding-top: 0;
    padding-bottom: 0;
    background: none !important;
    position: relative;
  }
}
header .navbar .nav-link {
  padding: 1.7rem 1rem;
  outline: none !important;
  font-size: 1rem;
  color: black !important;
  transition: all 0.2s;
}
header .navbar .nav-link:hover {
 color: #523680  !important;
}
@media (max-width: 1199.98px) {
  header .navbar .nav-link {
    padding: 0.5rem 0rem;
  }
}
header .navbar .nav-link.active {
  color: black !important;
}
header .navbar .dropdown-menu {
  font-size: 14px;
  border-radius: 4px;
  border: none;
  -webkit-box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
  box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
  min-width: 13em;
  margin-top: -10px;
}
header .navbar .dropdown-menu:before {
  bottom: 100%;
  left: 10%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-bottom-color: #fff;
  border-width: 7px;
}
@media (max-width: 991.98px) {
  header .navbar .dropdown-menu:before {
    display: none;
  }
}
header .navbar .dropdown-menu .dropdown-item:hover {
  background: #523680;
  color: #fff;
}
header .navbar .dropdown-menu .dropdown-item.active {
  background: #523680;
  color: #fff;
}
header .navbar .dropdown-menu a {
  padding-top: 7px;
  padding-bottom: 7px;
}
header .navbar .cta-btn a {
  background: #523680;
  color: #fff !important;
  text-transform: uppercase;
  font-size: 0.8rem;
  padding: 15px 20px !important;
  line-height: 1;
  font-weight: bold;
  -webkit-transition: 0.3s all ease;
  -o-transition: 0.3s all ease;
  transition: 0.3s all ease;
}
header .navbar .cta-btn a:hover {
  background: #fff;
  color: #523680 !important;
  -webkit-box-shadow: 2px 0 30px -5px rgba(0, 0, 0, 0.2);
  box-shadow: 2px 0 30px -5px rgba(0, 0, 0, 0.2);
}
.navbar-dark .navbar-toggler{
    color: #523680;

}
.navbar-dark .navbar-toggler-icon {
  background-image: url(https://i.ibb.co/72nTgZV/588a6507d06f6719692a2d15.png);
}
@media(max-width:500px){
  .logo{
   width: 10rem; 
  }
}
/* //////////////////////////////////// hero section /////////////////////////// */
.herosection {
  padding: 3rem 0 4rem;
  background-image: url("../assets/img");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
}

.herosection__left {
  display: flex;
  flex-direction: column;
  justify-content: left;
  align-items: flex-start;
}
.welcome-text {
  margin-top: 2rem !important;
}

.herosection__right {
  margin-top: 0 !important;
  display: flex;
  justify-content: center;
  align-items: center;
}

.herosection__img {
  margin-top: 0 !important;
  width: 100%;
}

.herosection__heading__first {
  font-size: 3.2rem;
  font-weight: 700;
  width: 100%;
  margin-top: 2rem !important;
  margin-bottom: 2rem !important;
}

.herosection__heading__last {
  font-size: 1.2rem;
  margin-bottom: 0.4rem !important;
}

/* course list */
.course-full-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  padding: 2rem 0rem;
  gap: 1.5rem;
  text-align: left;
}

.packages-ul {
  padding-left: 0 !important;
  list-style: none;
  line-height: 30px;
}
.packages-ul li {
  display: flex;
  align-items: center;
  gap: 10px;
}
.course-full-items {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  background-color: #ffffff;
  border-radius: 20px;
  padding: 1rem 0.7rem;
  transition: all 0.5s;
}

.course-full-items:hover {
  transform: translateY(-10px);
}
.course-full-list-text {
  font-size: 11px;
}

.course-list-icon {
  font-size: 2rem;
  background-color: var(--Secondary-color);
  text-align: center !important;
  color: #ffffff;
  display: flex !important;
  justify-content: center;
  border-radius: 50%;
  align-items: center !important;
  height: 5rem;
  width: 5rem;
}

.section-heading {
  font-size: 3rem !important;
  font-weight: 700;
  margin-bottom: 2rem !important;
}

/* section new course */
.course-feature {
  margin: 2rem auto;
}
.course-feature-box {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.7rem !important;
}
.section-new-course {
  padding: 5rem !important;
  background-color: #ffffff;
}

.product-img {
  position: relative;
  border-top-left-radius: 10px !important;
  border-top-right-radius: 10px !important;
  transition: all 0.3s;
}

.product-img:hover {
  transform: scale(1.1);
}

.course-box,
.product {
  border-radius: 10px;
}

.course-box {
  /* border: 0.2px solid var(--primary-color); */
  color: black !important;
  background-color: white;
  transition: all 1s;
  box-shadow: 0px 5px 5px 5px #0000001c;
}

.course-name {
  font-weight: bolder;
  font-size: 20px;
}

.product-content {
  padding: 1rem;
  background-color: #f7f7f9;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}

.course-title {
  color: black !important;
  font-weight: bolder;
  margin-bottom: 1rem !important;
}

.course-box {
  margin-bottom: 1rem;
}

/* lead gutu section */
.skill-slider-section {
  padding: 5rem 0;
}

.skill-slider-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

.lead-guru-box {
  display: flex;
  padding: 2rem 1rem;
  flex-direction: column;
  justify-content: space-evenly;
  gap: 10px;
  text-align: center;
  border-radius: 10px;
  align-items: center;
  background-color: #ffffff;
}

.why-choose-us {
  padding: 5rem 0;
}

.certified-group-box {
  /* align-items: center; */
  text-align: center;
  border: 1px solid rgba(128, 128, 128, 0.286);
  margin: 1rem auto;
  padding: 0.8rem 1rem 1.3rem;
  border: 1px solid var(--Secondary-color);
  box-shadow: 0px 2px 5px #0000001c;
  height: 7rem;
  border-radius: 10px;
  transition: all 0.3s;
}

.certified-group-box:hover {
  transform: translateY(-10px);
}

.certified-group-icon {
  margin: auto 10px;
  color: var(--Secondary-color);
  font-size: 2.7rem;
  position: static !important;
}
.certifiate-img {
  margin: auto 0;
  width: 70px;
  height: 50px;
}
.choose-us-right-section img {
  width: 90%;
}

/*  ********************  slider  ******************/
.slider-starter {
  padding: 5rem 0 4rem;
  background-color: #ffffff;
}

.slider {
  width: 100%;
  margin: 2rem;
}

.slick-slide {
  margin: 0 1rem 0 0;
}

.carasoul-image {
  width: 100%;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  margin: 0 !important;
  padding: 0 !important;

  transition: all 0.3s;
}

.carasoul-image:hover {
  transform: scale(1.1);
}

.carasoul-textarea {
  padding: 1.3rem 1rem;

  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  background-color: #ffffff;
  text-align: center;
}

.slider-title {
  margin-top: 1rem;
  font-weight: bolder;
  font-size: 1.3rem;
}

.slider-text {
  color: #767676;
  font-weight: 400;
  font-size: 1rem;
}

.slick-prev:before,
.slick-next:before {
  color: black !important;
  display: none !important;
}

/* .slick-dots li button {} */

.slick-dots li button:before {
  position: absolute;
  top: 1rem;
  left: 0;
  width: 1rem !important;
  height: 1rem !important;
  text-align: center;
  opacity: 0.25;
  color: transparent !important;
  border-radius: 50%;
  background-color: var(--Secondary-color) !important;
  transition: all 0.2s;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.slick-dots li:hover button::before {
  margin: 0rem 0 0 !important;
  width: 1.4rem !important;
  border-radius: 20px;
}

/* meat founder */
.meet-founder-stater {
  padding: 5rem 0;
}

.meet-founder-section {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
}

.meet-founder-section-img {
  width: 85%;
  border-radius: 20px;
  transition: all 0.3s;
}

.meet-founder-section-img:hover {
  transform: scale(1.1);
}

/* caeasoul hear from our     */
.main-text {
  width: 60%;
}

.slider-section-2-head {
  padding: 0 2rem;
}

.carasoul-textarea-2 {
  padding: 1rem;
  height: auto !important;

  background-color: #ffffff;
  color: black !important;
  border-radius: 20px;
}
.hear-from-slider {
  background-color: var(--primary-color);
  padding: 1rem !important;
}

.joining-section {
  display: grid;
  gap: 2rem;
  grid-template-columns: repeat(2, 1fr);
}

.joining-heading {
  font-size: 2rem;
  line-height: 3.2rem;
  font-weight: bolder;
  margin-bottom: 1.4rem !important;
}

/* update section via emila */
.update-section-starter {
  padding: 5rem 14rem;
}

.update-section {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.update-email-section {
  display: flex;
  gap: 1rem;
  justify-content: center;
  align-items: center;
}

.update-email {
  color: var(--Secondary-color) !important;
  background-color: transparent !important;
  outline: none !important;
  width: 20rem;
  border: none !important;
  text-align: left !important;
  border-bottom: 2px solid var(--Secondary-color) !important;
}

.update-inform {
  margin: 3rem 0 0 0;
  padding: 2rem;
  text-align: left !important;
  border-radius: 10px;
  background-color: var(--Secondary-color);
  color: #ffffff;
}
/* user profile */
.user-profile-icon {
  padding: 0.7rem 0;
}
.user-profile-icon a i {
  font-size: 1.2rem;
  padding: 10px;
  border-radius: 50%;
  transition: 0.5s all;
}
.user-profile-icon a i:hover {
  background-color: var(--primary-color);
  color: #ffffff;
}
/* footer */
.footer-starter {
  padding: 5rem 0 1rem !important;
  font-size: 14px !important;
  box-shadow: 7px 1px 9px 7px #0000001c;
}
.footer-text {
  font-size: 14px !important;
}
.footer-flex {
  border-bottom: 2px solid rgba(128, 128, 128, 0.46);
  margin: 0 0rem 1rem;
  padding-bottom: 3rem;
}

.footer-col ul {
  text-align: left !important;
  list-style: none;
}

.footer-col ul strong {
  font-size: 1.4rem;
  margin: 2rem 0 !important;
  padding-bottom: 6px;
  border-bottom: 2px solid var(--Secondary-color);
}

.footer-col ul li {
  margin: 0.6rem 0;
}

.footer-col ul li a {
  color: black !important;
  transition: 0.4s;
  position: relative;
}

.footer-col ul li a:hover {
  color: var(--Secondary-color) !important;
}

.footer-col ul li a:after {
  content: "";
  position: absolute;
  background-color: var(--Secondary-color);
  height: 2px;
  width: 0%;
  left: 0px;
  bottom: -2px;
  transition: 0.4s;
}

.footer-col ul li a:hover:after {
  width: 100%;
}

.footer-address {
  margin: 1rem 0 0;
}

/* contact page starter */
.contact-page-section {
  display: grid;
  grid-template-columns: 3fr 7fr;
  gap: 1rem;
  margin: 5rem auto;
}

.contact-left-section {
  background-color: var(--Secondary-color);
  color: #ffffff;
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding: 3rem 2rem;
  border-radius: 10px;
}

.contact-right-section {
  padding: 2rem;
  border-radius: 10px;
  border: 0.2px solid rgba(128, 128, 128, 0.323);
  background-color: #ffffff;
}

.form-group {
  margin: 1rem 0;
}

.contact-form {
  margin-bottom: 1rem;
}

.contact-btn {
  border-radius: 0 !important;
}

.contact-left-icon-box {
  display: flex;
  gap: 1rem;
  text-align: left !important;
  margin: 1rem 0;
}

.contact-left-icon {
  font-size: 2rem;
  padding: 10px;
  border: 5px solid white !important;
}

/* courses pages */
.inner-banner {
  height: 40vh;
  width: 100%;

  background-image: url(https://leadsguru7231.leadsguru.in/UploadImages/a7ecaf0a-3363-4a26-922b-fff03c84d4bb_banner.jpg);
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  color: #ffffff;
  position: relative;
}
.gold-banner {
  background: url(https://leadsguru7231.leadsguru.in/UploadImages/913b027f-71bc-483a-a3d0-657bfe801240_banner.jpg) !important;
}
.platium-banner {
  background: url(https://leadsguru7231.leadsguru.in/UploadImages/bd85dbf1-030d-41c5-80ba-d71b28c0128a_banner.jpg) !important;
}
.about-banner {
  background: url("../assets/img/About-Us.png") !important;
  background-size: cover;
  background-position: center !important;
  background-repeat: no-repeat !important;
  background-attachment: fixed !important;
}
.contact-banner {
  background: url("../assets/img/Contact-Us-2.png") !important;
  background-size: cover;
  background-position: center !important;
  background-repeat: no-repeat !important;
  background-attachment: fixed !important;
}
.inner-banner-text {
  position: absolute;

  padding: 1rem 5rem !important;
}

.inner-banner:before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: #0000006b;
}

.inner-banner-courses {
  display: flex;
  gap: 2rem;
}

.courses-starter {
  position: relative;
  margin: 5rem auto;
  display: grid;
  grid-template-columns: 8fr 4fr;
  gap: 1rem;
}

.courses-left-section {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.courses-left-section-first-col,
.courses-left-section-second-col-carasoul-starter,
.courses-left-section-third-col,
.courses-left-section-fourth-col {
  background-color: #ffffff;
  border-radius: 10px;
  padding: 2rem 1rem;
  border: 1px solid rgba(128, 128, 128, 0.452);
}

/* FAQ SECTION ////////////////////// */
.carasoul-left-top {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.faq-section {
  color: black;
  margin-bottom: 0.7rem;
  cursor: pointer;
  border: 0.2px solid var(--primary-color);
}

.faq-section-main-div {
  border-bottom: 0.2px solid var(--primary-color);

  display: flex;
  padding: 1rem;
  justify-content: space-between;
  gap: 10px;
  align-items: center;
}

.faq-section-heading {
  font-size: 16px;
  font-weight: bold;
  color: var(--Secondary-color);
}

.faq-section-icon {
  font-size: 1.2rem !important;
  font-weight: bolder;
  color: #ffffff !important;
  padding: 5px 7px;
  border-radius: 50%;
  background-color: var(--Secondary-color);
}

.faq-answer {
  display: flex !important;
  gap: 0.7rem;
  margin: 0.5rem 1rem auto;
  padding: 0.5rem 1rem !important;
  border-bottom: 1px solid gray;
}

/* faq question end*/
.courses-certificate-img {
  width: 100%;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.199);
}

.courses-left-section-fourth-col {
  display: flex;
  justify-content: center;
  align-items: center;
}

.courses-slider-starter {
  width: 40rem !important;
}

.courses-right-section-first-row {
  /* width: 24rem; */
  position: absolute;
  top: -14rem;
  padding: 1.5rem;
  background-color: #ffffff;
  border-radius: 10px;
}

.courses-right-section-img {
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  width: 100%;
  margin-bottom: 1rem;
}

.courses-right-section-play-icon {
  position: absolute;
  top: 8rem;
  left: 10.5rem;
  border-radius: 50%;
  background-color: #ffffff;
  padding: 0.6rem 1rem;
}

.courses-right-section-second-row {
  margin-top: 14rem;
  padding: 2rem 1rem;
  background-color: #ffffff;
  border-radius: 10px;
  border: 1px solid rgba(128, 128, 128, 0.452);
}

/* about */
.about-company-check-icon {
  background-color: var(--Secondary-color);
  border-radius: 50%;
  padding: 4px 4px;
  color: #ffffff;
  font-size: 10px;
  display: flex;
  justify-content: center;
}

.about-approach-icon {
  font-size: 3rem;
  color: var(--Secondary-color);
}

.about-revolution {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 4rem 0;
  flex-direction: column;
}

.blog-carasoul-grid-section {
  display: grid !important;
  grid-template-rows: repeat(2, 1fr);
  grid-column-gap: 1rem;
  grid-row-gap: 2rem;
}

.blog-carasoul-grid-box-last-section {
  background: #f7f7f9;
  padding: 1rem;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  gap: 10px;
}

.blog-carasoul-grid-box-detail {
  display: flex;
  gap: 1rem;
}

.blog-carasoul-grid-box-heading {
  font-size: 1.2rem;
  font-weight: bolder;
}

.blog-carasoul-grid-box-heading:hover {
  color: var(--primary-color);
}

.blog-carasoul-grid-box-text {
  overflow-x: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.footer-brands-div {
  margin: 1rem 0 0;
  display: flex;
  justify-content: space-evenly;
}
.footer-brands-icon {
  font-size: 1.4rem;
  border-radius: 50%;
  padding: 0.6rem;
  color: var(--Secondary-color);
  transition: all 0.5s;
}
.footer-brands-icon:hover {
  background-color: var(--Secondary-color);
  color: #ffffff;
}
</style>
<body>
   
       
            <div class="border-pattern" id="contentToConvert">
                <div class="content">
                 <div class="inner-content">
                  <h1>Certificate</h1>
                  <h5 class="">of <b>Completion</b></h5>
                  <p class="my-3 text-uppercase">This Certificate Is proudly Presented To</p>
                  <h3 >{{$student_name}}</h3>
                  <p class="my-3 text-capitalize">Congratulations on completing the ( 
                    <span style="color: #f46f22;">{{$course_title}}</span> )
                  from <b>Skillsider</b> wishing you all the best for a successful future!
                    </p>
                    <div class="row   align-items-center">
                        <div class="col-md-6 col-sm-12 "><img src="{{asset ('studens-asset/assets/img/Logo-1.png')}}" alt="" width="200">
                        </div>
                        <div class="col-md-6  col-sm-12 badge">
                            <img src="{{asset ('assets/images/skillsider_logo.png')}}" alt="" >
                        </div>
                    </div>
               
                 </div>
                </div>
               </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
               
                <script>
                    // Your JavaScript code here
                    window.onload = function() {
                        var element = document.getElementById('contentToConvert');
                        // Use html2pdf to generate a PDF
                        html2pdf()
                            .from(element)
                            .save();
                    };
                </script>

   
</body>
</html>