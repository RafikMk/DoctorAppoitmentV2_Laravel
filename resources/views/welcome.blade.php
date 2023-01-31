@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img src="{{ asset('/banner/online-medicine-concept_160901-152.jpg') }}" class="img-fluid" style="border:1px solid #ccc;">

        </div>   
        <div class="col-sm-6">
            <h2>Doctor's Appointment</h2>
            <p> Notre page d'accueil pour l'application de gestion de rendez-vous 
                médicaux est conçue pour offrir une expérience utilisateur intuitive 
                et efficace. Avec une interface simple et claire, les patients peuvent 
                facilement trouver les informations dont ils ont besoin pour prendre 
                rendez-vous avec leur médecin. Les informations de base sur les médecins
                 disponibles, les horaires de rendez-vous, les disponibilités et les tarifs
                  sont clairement affichées. Les patients peuvent également gérer leurs 
                  rendez-vous en temps réel, recevoir des notifications pour les rappels 
                  et les annulations, et accéder à leur historique de rendez-vous. Nous avons
                   créé cette application pour simplifier le processus de prise de rendez-vous
                    médicaux pour les patients, tout en fournissant une solution efficace pour 
                    les professionnels de la santé.



</p>
            <div class="mt-5">
      <!--     <find-doctors />        <a href="{{ url('/register') }}"><button class="btn btn-success">Register as Patient</button></a>
 -->
            <a href="{{ url('/login') }}"><button class="btn btn-secondary">Login</button></a>
        </div>
        </div>
        
    </div>
    <hr>
<!--     <find-doctors /> -->

    
</div>      
@endsection
