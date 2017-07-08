@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="about-site">
                <h2>About</h2>
                <p>Sign in with twitter. Write a tweet, set time or leave it (if you post it at once) and post. Your tweet will be posted at scheduled time.</p>
                <a href="https://github.com/faysal-ishtiaq/queuet"><i class="fa fa-github"></i> View on Github</a>    
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>What was used?</h3>
            <ul class="list">
                <li class="item">Laravel Framework</li>
                <li class="item">Bootstrap</li>
                <li class="item">Bootstrap DateTimePicker</li>
                <li class="item">jQuery</li>
                <li class="item">Twitter REST API</li>
                <li class="item">Laravel artisan command</li>
                <li class="item">Laravel Pagination</li>
                <li class="item">Laravel Queue</li>
                <li class="item">Laravel Task Scheduler/Scheduled Jobs (Cron Job)</li>
                <li class="item">Laravel CRUD using ORM</li>
                <li class="item">Laravel One to Many, One to One relationship.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Developed by:</h4>
            <h5>Faysal Ishtiaq Rabby</h5>
            <a href="mailto:f.i.rabby@gmail.com">f.i.rabby@gmail.com</a>
            <h5>Upwork Profile: <a href="https://www.upwork.com/o/profiles/users/_~01cf61f7d48fe20aad/">Faysal Ishtiaq Rabby</a></h5>
            
            <ul class="list-inline my-profiles">
                <li class="list-inline-item">
                    <a href="https://facebook.com/faysal.ishtiaq" class="btn btn-social btn-facebook">
                        <span class="fa fa-facebook"></span> Faysal Ishtiaq Rabby
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://twitter.com/Faisal_Ishtiaq" class="btn btn-social btn-twitter">
                        <span class="fa fa-twitter"></span> @Faisal_Ishtiaq
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://www.linkedin.com/in/firabby/" class="btn btn-social btn-linkedin">
                        <span class="fa fa-linkedin"></span> Faysal Ishtiaq Rabby
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://github.com/faysal-ishtiaq" class="btn btn-social btn-github">
                        <span class="fa fa-github"></span> Faysal Ishtiaq Rabby
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
