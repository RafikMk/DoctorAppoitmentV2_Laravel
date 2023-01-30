<!-- resources/views/chat.blade.php -->

@extends('admin.layouts.main')

@section('content')

<div id="app" class="container">
    <div class="row">
    <div class="col-md-4 col-md-offset-2">
   <list-messages v-on:displayconversation="displayconversation"  v-on:change="change"  :user="{{ Auth::user() }}"

></list-messages>
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
