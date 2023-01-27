<!-- resources/views/chat.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-4 col-md-offset-2">
    <section class="discussions">
        <div class="discussion search">
          <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search..."></input>
          </div>
        </div>
        <div class="discussion message1-active">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Megan Leib</p>
            <p class="message1">9 pm at the bar if possible 😳</p>
          </div>
          <div class="timer">12 sec</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Dave Corlew</p>
            <p class="message">Let's meet for a coffee or something today ?</p>
          </div>
          <div class="timer">3 min</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Jerome Seiber</p>
            <p class="message1">I've sent you the annual report</p>
          </div>
          <div class="timer">42 min</div>
        </div>

      </section>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
