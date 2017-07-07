@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom: 100px;" class="tweet-text">
                <form action="{{url('/tweets')}}" method="POST">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <textarea class="form-control" name="tweet_text" id="tweet-text" rows="3"></textarea>
                    </div>

                    <div class="row m0">
                        <div class="col-md-6 p0">
                            <div class="form-group">
                                <span class="pull-left"><span id="charCount">140</span> remaining</span>
                            </div>                        
                        </div>

                        <div class="col-md-6 p0">
                            <div class="form-group">                       
                                <div class='input-group date pull-left' id='tweet-datetimepicker'>
                                    <input type='text' class="form-control"  name="tweet_time"/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>      
                        </div>                        
                    </div>

                    
                    <div class="form-group mt10">
                        <button class="btn btn-primary pull-right" type="submit" name="submit"><i class="fa fa-twitter" style="color: #fff;"></i>Tweet</button> 
                    </div>                  
                
                    
                </form>
            </div>
            
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
            @endif
        
        </div>

        <div class="col-md-6">
            <div class="row m0">
            @include('partials.scheduled_tweets')
            </div>
            
            <!--<div class="row m0">-->
                <!--<div class="panel panel-default">-->
                    <!--<div class="panel-heading">Scheduled Direct Messages</div>-->

                    <!--<div class="panel-body">-->
                        {{--@if(isset($scheduledDms) && count($scheduledDms))
                            @foreach($scheduledDms as $dm)
                            @endforeach
                        @else
                            Nothing scheduled yet
                        @endif--}} 
                    <!--</div>-->
                <!--</div>                -->
            <!--</div>-->
        </div>
    </div>
</div>
@endsection
