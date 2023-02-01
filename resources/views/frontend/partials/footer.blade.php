<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{ asset('frontend/images/send.png') }}" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="{{ route('newsletter.store') }}" method="POST" class="newsletter_form">
                            @csrf

                            <input type="email" class="newsletter_input" name="email" required="required" placeholder="Enter your email address">
                            <button type="submit" class="newsletter_button">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $page_ones = App\Models\Page::where('page_position',1)->get();
    $page_twos = App\Models\Page::where('page_position',2)->get();
@endphp

<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="#">OneTech</a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone">+38 068 005 3570</div>
                    <div class="footer_contact_text">
                        <p>17 Princess Road, London</p>
                        <p>Grester London NW18JR, UK</p>
                    </div>
                    <div class="footer_social">
                        <ul>
                            <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Find it Fast</div>
                    <ul class="footer_list">
                        @if (!empty($page_ones))
                            @foreach ($page_ones as $page_one)
                                <li><a href="{{ route('page.view',$page_one->page_slug) }}">{{ $page_one->page_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <ul class="footer_list footer_list_2">
                        @if (!empty($page_twos))
                            @foreach ($page_twos as $page_two)
                                <li><a href="{{ route('page.view',$page_two->page_slug) }}">{{ $page_two->page_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="#">Wish List</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Become a Vendor</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>
