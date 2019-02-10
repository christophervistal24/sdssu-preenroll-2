@extends('templates.master')
@section('content')
  <!--==========================
      Testimonials Section
    ============================-->
    <section id="testimonials" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <p>In order to finish our study this research we made is to make the <b>Online Pre-Enrollment , Class Scheduling and Evaluation with SMS Alert</b> for the College of Engineering Computer Studies and Technology easier thru Website. We Bachelor of Science in Computer Science come up with this research to solve the sluggishness of transactions we encountered in our department (CECST).</p>

          <p><br>We are hoping that this research can alter the problem of beneficiaries in doing transactions at College of Engineering, Computer Studies and Technology one of the four departments in SDSSU Main-Campus.</p>
        </div>
          <div class="section-header" id="aboutus">
          <h2>Researchers </h2>
        </div>
        <div class="owl-carousel testimonials-carousel">

            <div class="testimonial-item">
              <p>
                <img src="{{ url('/storage/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                Ambition is the path to success. Persistence is the vehicle you arrive in.
                <img src="{{ url('/storage/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
              </p>
              <img src="{{url('/storage/joshua.jpg')}}" class="testimonial-img" alt="">
              <h3>Joshua V. Safico</h3>
              <h4>Leader</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="{{ url('/storage/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                A champion is afraid of losing. Everyone else is afraid of winning. 
                <img src="{{ url('/storage/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
              </p>
              <img src="{{url('/storage/ellyn.jpg')}}" class="testimonial-img" alt="">
              <h3>Ellyn S. Biol</h3>
              <h4>Assistant Leader</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="{{ url('/storage/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                Failure is the key to success; each mistake teaches us something.
                <img src="{{ url('/storage/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
              </p>
              <img src="{{url('/storage/lowe.jpg')}}" class="testimonial-img" alt="">
              <h3>Louie Mae G. Marinduque</h3>
              <h4>Researcher</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="{{ url('/storage/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                 All you need in this life is ignorance and confidence, and then success is sure.
                <img src="{{ url('/storage/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
              </p>
              <img src="{{url('/storage/mon.jpg')}}" class="testimonial-img" alt="">
              <h3>Jover Jhon Villamon</h3>
              <h4>Researcher</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="{{ url('/storage/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                Success is not a destination it is a journey.
                <img src="{{ url('/storage/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
              </p>
              <img src="{{url('/storage/gard.jpg')}}" class="testimonial-img" alt="">
              <h3>Edgardo D. Intas Jr.</h3>
              <h4>Document</h4>
            </div>

        </div>

      </div>
    </section><!-- #testimonials -->
@endsection
