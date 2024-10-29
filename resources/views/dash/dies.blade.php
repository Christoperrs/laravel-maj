<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <!-- site metas -->
    <title>Informasi Dies</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/barcode-page/css/bootstrap.min.css') }}" />
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/barcode-page/css/style.css') }}" />
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/barcode-page/css/responsive.css') }}" />
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/vendor/barcode-page/images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/barcode-page/css/jquery.mCustomScrollbar.min.css') }}" />
    <!-- AOS for animate on scroll -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
</head>
<body>
    <!-- header section start -->
    <div class="header_section" data-aos="fade-up" style="position: fixed; width: 100%; top: 0; z-index: 10;">
        <div class="header_main">
            <div class="mobile_menu">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="logo_mobile">
                        <a href="{{ asset('index.html') }}"><img src="{{ asset('assets/images/logos.png') }}" /></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <!-- <a class="nav-link" href="{{ asset('index.html') }}">Home</a> -->
                            </li>
                            <!-- More nav items -->
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
                <div class="logo">
                    <a href="{{ asset('index.html') }}"><img src="{{ asset('assets/images/logos.png') }}" style="max-width: 250px" /></a>
                </div>
                <div class="menu_main">
                    <ul>
                        <!-- Add nav items here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="background_bg" data-aos="fade-up">
        <div class="watchs_section layout_padding" data-aos="fade-up"><!-- Particle.js background -->
        <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0;"></div>

    <!-- Main content slider -->
        <div id="main_slider" style="position: relative; z-index: 1; height: 100vh;">
            <div  style="height: 100vh; margin-top: -50px">
                <div  style="height: 100vh; display: flex; align-items: center;">
                    <div class="container text-center d-flex flex-column justify-content-start" style="height: 100vh; padding-top: 15vh;">
                    <h3 class="banner_taital">Dies Information System</h3>
                    <hr style="border: 1px solid #ccc; width: 50%; margin: 0 auto;">
                        <!-- Company Boxes -->
                        <div class="company-boxes mt-3">
                            <div class="row align-items-center g-4">
                                @foreach($product as $product)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    <a href="{{ route('dash.show', ['id' => $product->id]) }}" class="company-box-link">
     
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/suzuki.png') }}" alt="Product Image" class="product-image">
                                        <div class="product-info">
                                            <h3>{{ $product->name }}</h3>
                                            <p>Part No: {{ $product->part_no }}</p>
                                            <p>Process: {{ $product->process }}</p>
                                            <p>Model: {{ $product->model }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

   

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 
    <!-- footer section end -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/barcode-page/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/barcode-page/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/barcode-page/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // values from 0 to 3000, with step 50ms
            easing: "ease-in-out", // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            delay: 70, // values from 0 to 3000, with step 50ms
        });
    </script>
    <script>
        function changeMainImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc; // Change the main image source
        }
    </script>
    <!-- Particles.js script -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
 // Initialize particles effect
particlesJS("particles-js", {
    particles: {
        number: { value: 80, density: { enable: true, value_area: 800 }},
        color: { value: "#ffffff" },
        shape: { type: "circle" },
        opacity: { value: 0.5, random: false },
        size: { value: 3, random: true },
        line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
        move: { enable: true, speed: 6, direction: "none", random: false, straight: false, out_mode: "out", bounce: false },
    },
    interactivity: { detect_on: "canvas", events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" }, resize: true }},
    retina_detect: true,
});



</script>
<style>
.company-box {
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    width: 100%; /* Changed from fixed width to 100% */
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.product-image {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ccc;
    max-height: 150px; /* Add max-height to maintain consistency */
    object-fit: cover;
}

.product-info {
    padding: 10px;
}

.product-info h3 {
    font-size: 1rem; /* Reduced font size */
    margin: 0.5em 0;
}

.product-info p {
    margin: 0.2em 0;
    color: #555;
    font-size: 0.9rem; /* Reduced font size */
}

@media (max-width: 768px) {
    .company-box {
        padding: 5px;
    }
    
    .product-info h3 {
        font-size: 0.9rem;
    }
    
    .product-info p {
        font-size: 0.8rem;
    }
}
</style>
<style>
    .banner_section {
        position: relative;
        overflow: hidden;
    }

    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: transparent;
        top: 0;
        left: 0;
    }
    /* Modal Custom Styles */
.modal-content {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
}

.modal-header {
    border-bottom: none;
    padding: 1rem 1.5rem;
    background: #007bff;
}

.modal-title {
    font-weight: bold;
}

.close {
    font-size: 1.2rem;
}

.modal-body {
    padding: 2rem;
}

/* Product Box Styling */
.product-box {
    padding: 1rem;
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    cursor: pointer;
    text-align: center;
}

.product-box:hover {
    transform: translateY(-4px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
}

.product-box p {
    margin: 0;
    font-weight: bold;
    color: #333;
}

.footer_section {
          
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
</style>
</body>
</html>