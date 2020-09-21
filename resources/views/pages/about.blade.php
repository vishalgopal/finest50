@extends('layout.main')

@section('title', 'About Us')

@section('meta')

@endsection
@section('content')
    <!-- Page title
      ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark include-header"
        style="padding: 250px 0; background-image: url('{{ asset("images/about-us/banner.jpg") }}'); background-size: cover; background-position: center center;"
        data-bottom-top="background-position:0px 400px;" data-top-bottom="background-position:0px -500px;">

        <div class="container clearfix">
            <h1>About Us</h1>
            <span>Everything you need to know about our Company</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
      ============================================= -->
    <section id="content">
        <div class="content-wrap pb-0">
            <div class="container clearfix">

                <div class="row col-mb-50 mb-0">

                    <div class="col-lg-4">

                        <div class="heading-block fancy-title border-bottom-0 title-bottom-border">
                            <h4>Why choose <span>Us</span>.</h4>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam
                            expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim
                            repellat earum perspiciatis.</p>

                    </div>

                    <div class="col-lg-4">

                        <div class="heading-block fancy-title border-bottom-0 title-bottom-border">
                            <h4>Our <span>Mission</span>.</h4>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam
                            expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim
                            repellat earum perspiciatis.</p>

                    </div>

                    <div class="col-lg-4">

                        <div class="heading-block fancy-title border-bottom-0 title-bottom-border">
                            <h4>What we <span>Do</span>.</h4>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam
                            expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim
                            repellat earum perspiciatis.</p>

                    </div>

                </div>

            </div>

            <div class="section m-0">
                <div class="container clearfix">

                    <div class="row col-mb-50">

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn">
                            <i class="i-plain i-xlarge mx-auto icon-users"></i>
                            <div class="counter counter-lined"><span data-from="100" data-to="846"
                                    data-refresh-interval="50" data-speed="2000"></span>K+</div>
                            <h5>Members</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="200">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-users2"></i>
                            <div class="counter counter-lined"><span data-from="3000" data-to="15360"
                                    data-refresh-interval="100" data-speed="2500"></span>+</div>
                            <h5>Users</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="400">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-question-circle1"></i>
                            <div class="counter counter-lined"><span data-from="10" data-to="408" data-refresh-interval="25"
                                    data-speed="3500"></span>*</div>
                            <h5>Q&A</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="600">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-line2-layers"></i>
                            <div class="counter counter-lined"><span data-from="60" data-to="1200"
                                    data-refresh-interval="30" data-speed="2700"></span>+</div>
                            <h5>Stories</h5>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row align-items-stretch">

                <div class="col-md-6 col-padding min-vh-75"
                    style="background: url('{{ asset ("images/about-us/ceo.jpg") }}') center center no-repeat; background-size: cover;">
                </div>

                <div class="col-md-6 col-padding">
                    <div>
                        <div class="heading-block">
                            <span class="before-heading color">CEO &amp; Co-Founder</span>
                            <h3>Shireen</h3>
                        </div>

                        <div class="row col-mb-50">

                            <div class="col-lg-10">
                                <p>Employment respond committed meaningful fight against oppression social challenges rural
                                    legal aid governance. Meaningful work, implementation, process cooperation, campaign
                                    inspire.</p>
                                <p>Advancement, promising development John Lennon, our ambitions involvement underprivileged
                                    billionaire philanthropy save the world transform. Carbon rights maintain healthcare
                                    emergent, implementation inspire social change solve clean water livelihoods.</p>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                            </div>


                        </div>

                    </div>
                </div>

            </div>

            <div class="row align-items-stretch">

                <div class="col-md-6 col-padding min-vh-75 order-md-last"
                    style="background: url('{{ asset ("images/about-us/co-founder.jpg") }}') center center no-repeat; background-size: cover;">
                </div>

                <div class="col-md-6 col-padding" style="background-color: #F5F5F5;">
                    <div>
                        <div class="heading-block">
                            <span class="before-heading color">Co-Founder</span>
                            <h3>John Doe</h3>
                        </div>

                        <div class="row col-mb-50">

                            <div class="col-lg-10">
                                <p>Employment respond committed meaningful fight against oppression social challenges rural
                                    legal aid governance. Meaningful work, implementation, process cooperation, campaign
                                    inspire.</p>
                                <p>Advancement, promising development John Lennon, our ambitions involvement underprivileged
                                    billionaire philanthropy save the world transform. Carbon rights maintain healthcare
                                    emergent, implementation inspire social change solve clean water livelihoods.</p>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section><!-- #content end -->

@endsection
