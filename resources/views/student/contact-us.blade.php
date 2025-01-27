@extends('layouts.student.master')
@section('main')
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
    <main >
        <!-- contact back image -->

        <!-- inner -->
        <div class="">

        </div>
            <div class="container contact-page-section">
                <div class="contact-left-section">
                    <div>
                        <h5 class="text-light">Let's Talk</h5>
                        <h5 class="fw-bold text-light">Keep Connected With Us</h5>
                    </div>
                        <div class="contact-left-icon-box">
                            <i class="fa-regular fa-envelope contact-left-icon rounded-pill"></i>
                          
                            <div class="my-auto">
                                <p>Email</p>
                                <p>contactskillsider@gmail.com</p>
                            </div>
                        </div>
                        {{-- <div class="contact-left-icon-box">
                            <i class="fa-solid fa-phone contact-left-icon rounded-pill"></i>
                            <div class="my-auto">
                                <p>Phone</p>
                                <p></p>
                            </div>
                        </div> --}}
                        <div class="contact-left-icon-box">
                            <i class="fa-brands fa-whatsapp contact-left-icon rounded-pill"></i>
                         
                            <div class="my-auto">
                                <p>whatsapp</p>
                                <p>+923478859046</p>
                            </div>

                        </div>
                </div>
                <div class="contact-right-section">
                    <h4 class="fw-bold"></h4>
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <div class="mb-5 mb-xxl-8">
                             
                                <div class="social-media-links">
                                    <a href="https://youtube.com/@skillsider" class="social-media-link">
                                        <img src="socialmedia-icon/youtube.png" alt="YouTube">
                                        <span>YouTube</span>
                                    </a>
                                    <a href="https://www.whatsapp.com/channel/0029VazEIc8A89MgoiA0zn1f" class="social-media-link">
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
    </main>


    @endsection
