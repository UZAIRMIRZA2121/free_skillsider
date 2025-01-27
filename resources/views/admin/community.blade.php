 @extends('layouts.admin.master') @section('admin')
     <style>
         body {
             font-family: Arial, sans-serif;
             margin: 0;
             padding: 0;
         }

         .social-media-links {
             display: flex;
             flex-wrap: wrap;
             justify-content: center;
         }

         .social-media-link {
             text-align: center;
             margin: 10px;
             text-decoration: none;
             color: #333;
             display: flex;
             flex-direction: column;
             align-items: center;
         }

         .social-media-link img {
             width: 100px;
             /* Adjust icon size */
             height: 100px;
             /* Adjust icon size */
             margin-bottom: 5px;
         }

         @media (max-width: 768px) {
             .social-media-link img {
                 width: 80px;
                 /* Adjust icon size for smaller screens */
                 height: 80px;
                 /* Adjust icon size for smaller screens */
             }
         }
     </style>


     <div class="d-flex flex-column flex-column-fluid">
         <!--begin::Toolbar-->
         <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
             <!--begin::Toolbar container-->
             <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                 <!--begin::Page title-->
                 <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                     <!--begin::Title-->
                     <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"></h1>
                     <!--end::Title-->
                     <!--begin::Breadcrumb-->
                     <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                         <!--begin::Item-->
                         <li class="breadcrumb-item text-muted">
                             <a href="#" class="text-muted text-hover-primary">Dashboard
                             </a>
                         </li>
                         <!--end::Item-->
                         <!--begin::Item-->
                         <li class="breadcrumb-item">
                             <span class="bullet bg-gray-400 w-5px h-2px"></span>
                         </li>
                         <!--end::Item-->
                         <!--begin::Item-->
                         <li class="breadcrumb-item text-muted">Community Links</li>
                         <!--end::Item-->
                     </ul>
                     <!--end::Breadcrumb-->
                 </div>
                 <!--end::Page title-->

             </div>
             <!--end::Toolbar container-->
         </div>
         <!--end::Toolbar-->
         <div id="kt_app_content" class="app-content flex-column-fluid">
             <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card  mb-2">
                        <div class="card-header cursor-pointer w-100 text-center">
                            <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/social.png') }}" alt=""
                                        width="30px" class="mx-3 mb-3">Community</span></h1>
                            
                        </div>
                </div>
                <div class="card  mb-2">
                    <div class="card-header cursor-pointer w-100 ">
                        <div class="header m-3" >
                            <h3> Follow Skill Sider Official Community Links</h3>
                           
                        </div>
                        <hr>
                 <div class="m-2 mb-xxl-8 " style="width: inherit">
                  
                     <div class="social-media-links">
                         <a href="https://youtube.com/@skillsider" class="social-media-link">
                             <img src="socialmedia-icon/youtube.png" alt="YouTube">
                             <span>YouTube</span>
                         </a>
                         <a href="https://whatsapp.com/channel/0029VaCun0IGehELSGQjdt3O" class="social-media-link">
                             <img src="socialmedia-icon/whatsapp.jpg" alt="WhatsApp">
                             <span>WhatsApp</span>
                         </a>

                         <a href="https://www.facebook.com/profile.php?id=100090331326574&mibextid=JRoKGi"
                             class="social-media-link">
                             <img src="socialmedia-icon/fb.jpg" alt="Facebook">
                             <span>Facebook</span>
                         </a>
                         <a href="https://instagram.com/skillsider.pk?igshid=MzRlODBiNWFlZA==" class="social-media-link">
                             <img src="socialmedia-icon/insta.jpg" alt="Instagram">
                             <span>Instagram</span>
                         </a>



                         <a href="https://www.tiktok.com/@amir_jafry?_t=8mmPKu3rrsO&_r=1" class="social-media-link">
                             <img src="socialmedia-icon/tiktok.png" alt="TikTok">
                             <span>TikTok</span>
                         </a>
                     </div>
                 </div>
                </div>
            </div>

             </div>
         </div>

     </div>
     <!--end::Content wrapper-->
 @endsection
