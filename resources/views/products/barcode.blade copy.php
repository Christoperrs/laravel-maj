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

    <div class="banner_section layout_padding" data-aos="fade-up" style="height: 100vh; position: relative;">
    <!-- Particle.js background -->
        <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0;"></div>

    <!-- Main content slider -->
        <div id="main_slider" class="carousel slide" data-ride="carousel" style="position: relative; z-index: 1; height: 100vh;">
            <div class="carousel-inner" style="height: 100vh;">
                <div class="carousel-item active" style="height: 100vh; display: flex; align-items: center;">
                    <div class="container text-center d-flex flex-column justify-content-start" style="height: 100vh; padding-top: 15vh;">
                       
                        <!-- Company Boxes -->
                        <div class="company-boxes">
                            <div class="row justify-content-center align-items-center g-4">
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/adm.png') }}" alt="ADM" class="img-fluid">
                                        <p class="mt-2 mb-0">ADM PLANT</p>
                                    </div>
                                </div>
                              
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/toyota.png') }}" alt="TMMIN" class="img-fluid">
                                        <p class="mt-2 mb-0">TMMIN</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/mkm.png') }}" alt="MKM" class="img-fluid">
                                        <p class="mt-2 mb-0">MKM</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/mmki.png') }}" alt="MMKI" class="img-fluid">
                                        <p class="mt-2 mb-0">MMKI</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/hmmi.png') }}" alt="HMMI" class="img-fluid">
                                        <p class="mt-2 mb-0">HMMI</p>
                                    </div>
                                </div>
                                <!-- New company boxes -->
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/suzuki.png') }}" alt="Suzuki" class="img-fluid">
                                        <p class="mt-2 mb-0">SUZUKI</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/gmr.png') }}" alt="GMR" class="img-fluid">
                                        <p class="mt-2 mb-0"><b>GMR</b></p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6 mb-3">
                                    <div class="company-box">
                                        <img src="{{ asset('assets/images/hpm.png') }}" alt="HPM" class="img-fluid">
                                        <p class="mt-2 mb-0">HPM</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- header section end -->

    <!-- background bg start -->
    <div class="background_bg" data-aos="fade-up">
        <div class="watchs_section layout_padding" data-aos="fade-up">
            <div class="container">
                <h1 class="watchs_taital">01<br />Spesifikasi</h1>
                <div class="watchs_section_2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image_1">
                                @if($product->image)
                                    @php
                                        // Path to the image
                                        $imagePath = storage_path('app/public/' . $product->image);
                                        // Check if the file exists and encode it in Base64
                                        $base64Image = null;

                                        if (file_exists($imagePath)) {
                                            $imageData = base64_encode(file_get_contents($imagePath));
                                            $base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
                                        }
                                    @endphp
                                    @if($base64Image)
                                        <img src="{{ $base64Image }}" alt="Product Image">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="uni_text">{{ $product->name }}</h5>
                            <p class="watchs_text"><span style="color : red">*</span>Line     :{{ $product->line }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>No Job   :{{ $product->no_job }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>Model    :{{ $product->model }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>OP       :{{ $product->process }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>Tension  :{{ $product->process }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>Frekuensi:{{ $product->frequency_production }}</p>
                            <p class="watchs_text"><span style="color : red">*</span>Customer:{{ $product->customer }}</p>
                            <!-- <h4 class="rate_text">
                                <span style="color: #1035ec">$</span>100
                            </h4>
                            <div class="read_bt1"><a href="#">Buy Now</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- more sections... -->
    </div>

    <!-- <div class="row">
        <div class="col-md-6">
            <div class="mb-4"></div>
        </div>

        <div class="col-md-6">
            <h5><i class="fas fa-images"></i> Image Gallery</h5>
            <div class="row">
                @foreach($product->detailPictures as $picture)
                    @php
                        // Path to the thumbnail image
                        $thumbnailPath = storage_path('app/public/' . $picture->path_gambar);
                        $base64Thumbnail = null;

                        if (file_exists($thumbnailPath)) {
                            $thumbnailData = base64_encode(file_get_contents($thumbnailPath));
                            $base64Thumbnail = 'data:image/' . pathinfo($thumbnailPath, PATHINFO_EXTENSION) . ';base64,' . $thumbnailData;
                        }
                    @endphp
                    <div class="col-4 mb-2">
                        @if($base64Thumbnail)
                            <img src="{{ $base64Thumbnail }}" alt="Thumbnail" class="img-fluid thumbnail" style="cursor: pointer;" onclick="changeMainImage('{{ $base64Thumbnail }}')">
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div> -->

    <div data-aos="fade-up">
        <div class="about_section layout_padding" data-aos="fade-up">
            <div class="container">
                <h1 class="watchs_taital">02<br />Detail Gambar</h1>
                <div class="about_section_2">
                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-image"></i> Main Image</h5>
                            <div class=" p-2 rounded bg-light text-center">
                                @if($product->detailPictures->isNotEmpty())
                                    @php
                                        // Get the first image as the main image
                                        $mainImagePath = storage_path('app/public/' . $product->detailPictures->first()->path_gambar);
                                        $base64MainImage = null;

                                        if (file_exists($mainImagePath)) {
                                            $mainImageData = base64_encode(file_get_contents($mainImagePath));
                                            $base64MainImage = 'data:image/' . pathinfo($mainImagePath, PATHINFO_EXTENSION) . ';base64,' . $mainImageData;
                                        }
                                    @endphp
                                    @if($base64MainImage)
                                        <img id="mainImage" src="{{ $base64MainImage }}" alt="Main Image" class="img-fluid" style="max-width: 100%; max-height: 300px;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                @else
                                    <p>No image available</p>
                                @endif
                               
                              </div>
                        </div>
                    </div>
                </div>
                <div class="about_section_3">
                    <div class="row">
                        @foreach($product->detailPictures as $picture)
                            @php
                                // Path to the thumbnail image
                                $thumbnailPath = storage_path('app/public/' . $picture->path_gambar);
                                $base64Thumbnail = null;

                                if (file_exists($thumbnailPath)) {
                                    $thumbnailData = base64_encode(file_get_contents($thumbnailPath));
                                    $base64Thumbnail = 'data:image/' . pathinfo($thumbnailPath, PATHINFO_EXTENSION) . ';base64,' . $thumbnailData;
                                }
                            @endphp
                            <div class="col-md-3 mb-3">
                                <div class="border_main">
                                    <div class="image_4">
                                        @if($base64Thumbnail)
                                            <img src="{{ $base64Thumbnail }}" alt="Thumbnail" class="img-fluid thumbnail" style="cursor: pointer;" onclick="changeMainImage('{{ $base64Thumbnail }}')">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div  data-aos="fade-up">
        <div class="watchs_section layout_padding" data-aos="fade-up">
            <div class="container">
                <h1 class="watchs_taital">03<br />Detail Part</h1>
                <div class="watchs_section_2">
                    <div class="row">
                      <div class="col-md-12">
                      <h5 class="text-center"><i class="fas fa-puzzle-piece"></i> Parts</h5>
                          @if($product->parts->isNotEmpty())
                              <table class="table table-hover table-bordered  ">
                                  <thead class="table-white" style="background-color: #1035ec !important" >
                                      <tr>
                                          <th style="color: white !important">Item Part</th>
                                          <th style="color: white !important">Standart</th>
                                          <th style="color: white !important">Total Items Used</th>
                                      </tr>
                                  </thead>
                                  <tbody style="color: white !important">
                                      @foreach($product->parts as $part)
                                          <tr>
                                              <td>{{ $part->name }}</td>
                                              <td>
                                                  <ul>
                                                      @php
                                                          // Misalkan deskripsi dipisahkan oleh koma
                                                          $descriptions = explode(',', $part->description);
                                                      @endphp
                                                      @foreach ($descriptions as $description)
                                                          <li>- {{ trim($description) }}</li>
                                                      @endforeach
                                                  </ul>
                                              </td>
                                              <td>{{ $part->qty }} pcs</td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          @else
                              <p class="text-center" style="color: white !important">No parts associated with this product.</p>
                          @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  data-aos="fade-up">
        <div class="watchs_section layout_padding" data-aos="fade-up">
            <div class="container">
                <h1 class="watchs_taital">04<br />History Maintenance</h1>
                <div class="watchs_section_2">
                    <div class="row">
                      <h5 class="mt-4"><i class="fas fa-wrench"></i> History Maintenance</h5>
                        @if($maintenances->isNotEmpty())
                            <table class="table table-striped">
                                <thead class="table-white" style="background-color: white !important">
                                    <tr>
                                        <th style="color: black">ID</th>
                                        <th style="color: black">Note</th>
                                        <th style="color: black">Approval Status</th>
                                        <th style="color: black">Created At</th>
                                    </tr>
                                </thead>
                                <tbody style="color: white !important">
                                    @foreach($maintenances as $maintenance)
                                        <tr>
                                            <td>{{ $maintenance->id }}</td>
                                            <td>{{ $maintenance->note }}</td>
                                            <td>{{ $maintenance->approval_status }}</td>
                                            <td>{{ $maintenance->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="color: white !important">No maintenance records associated with this product.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  data-aos="fade-up">
        <div class="watchs_section layout_padding" data-aos="fade-up">
            <div class="container">
                <h1 class="watchs_taital">05<br />History Problem</h1>
                <div class="watchs_section_2">
                    <div class="row">
                      <h5 class="mt-4"><i class="fas fa-exclamation-triangle"></i> History Problems</h5>
                        @if($problems->isNotEmpty())
                            <table class="table table-striped">
                                <thead class="table-white" style="background-color: white !important">
                                    <tr>
                                        <th style="color: black">ID</th>
                                        <th style="color: black">Shift Problem</th>
                                        <th style="color: black">Penanggulangan</th>
                                        <th style="color: black">Status</th>
                                        <th style="color: black">Created At</th>
                                    </tr>
                                </thead>
                                <tbody style="color: white !important">
                                    @foreach($problems as $problem)
                                        <tr>
                                            <td>{{ $problem->id }}</td>
                                            <td>{{ $problem->shift_problem }}</td>
                                            <td>{{ $problem->penanggulangan }}</td>
                                            <td>{{ $problem->status }}</td>
                                            <td>{{ $problem->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="color: white !important">No problems associated with this product.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section start -->
    <div class="footer_section layout_padding" data-aos="fade-up">
        <div class="container">
            <h3 class="follow_text">New Armada</h3>
            <div class="social_icon">
                <ul>
                    <li>
                        <a href="#"><img src="{{ asset('assets/vendor/barcode-page/images/fb-icon.png') }}" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('assets/vendor/barcode-page/images/twitter-icon.png') }}" /></a>
                    </li>
                </ul>
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
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
  
        height: 70%; 
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .company-box:hover {
        transform: translateY(-5px);
    }

    .company-box img {
        width: 60px; /* Set a fixed width for the images */
    height: 60px; /* Set a fixed height for the images */
    object-fit: contain; /* Ensures the image scales without distortion */
    }

    .company-box p {
        text-align: center;
    padding: 10px;
    width: 100%; /* Makes all boxes the same width within their column */
    
    max-width: 100px; /* Adjust as needed for box width */
    }

    @media (max-width: 768px) {
        .company-box {
            padding: 10px;
        }
        
        .company-box p {
            font-size: 10px;
        }
        .company-box {
        margin-bottom: 15px; /* Space between boxes on smaller screens */
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
</style>
</body>
</html>