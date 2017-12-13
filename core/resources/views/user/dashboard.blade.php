<?php
if (!isset($_COOKIE['visited'])) { // no cookie, so probably the first time here
    setcookie ('visited', 'yes', time() + 5200000); // set visited cookie that will expire in two months

    header("Location: http://jacovox.co.za/user/user-edit");
    exit(); // always use exit after redirect to prevent further loading of the page
}
?>
@extends('layouts.user')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <style>
        .btn{
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"><strong><i class="fa fa-user"></i> Statement:</strong></div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="well well-lg">
                        <div class="profile-header-container">
                            <div class="profile-header-img">
                                <img style="width: 30%;" class="" src="{{ asset('assets/images') }}/Plan.png" />

                            </div>
                        </div>

						<style>
						td {border-color: #000;color:#000; text-align: left;}
                        #table-4_info,#table-4_paginate,#table-4_filter{display: none;}

						</style>

                        <div class="profile-body text-center">
                            <br>
                            <h3 style="text-align: left;">User Name: {{ $member->name }}</h3>
                            <!--<h3 style="text-align: left;">Identity Number: {{ $member->ID_Number or '_____'}}</h3>-->
                            <h3 style="text-align: left;"><?php echo 'Current Date: '.date('j  F Y');?></h3>
							<div class="row">


						<script type="text/javascript">
							jQuery( document ).ready( function( $ ) {
								var $table4 = jQuery( "#table-4" );

								$table4.DataTable( {
									dom: 'Bfrtip',
									buttons: [
										'pdfHtml5'
									]
								} );
							} );
						</script>
						
					<table class="table table-striped table-hover table-bordered " id="table-4">
			
                        <thead>
                        <tr>
                            <th style="background-color: #000;color: white;">Details</th>
                            <th style="background-color: #000;color: white;">Rands</th>                           
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Initial/Baseline Investment                                       .</td>
								<td>{{ $Initial or ''}}</td>
                            </tr>
							
							<tr>
                                <td><strong>Opening Balance</strong></td>
                                <td><strong>{{$Opening_Balance or ''}}</strong></td>
                            </tr>
							
							<tr>
                                <td>Less: Payout</td>
                                <td>{{ $Less_Payout  or ''}}</td>
                            </tr>

							<tr>
                                <td>Nett Balance for investment</td>
                                <td>{{$Nett_Balance or ''}}</td>
                            </tr>
							
							<tr>
                                <td>Plus: Growth for the Month</td>
                                <td>{{ $Growth_Amount or ''}}</td>
                            </tr>

							<tr>
                                <td>Nett Percentage Growth (%/month)</td>
                                <td style="background-color: #000;color: white;">{{$Percentage_Growth or ''}}</td>
                            </tr>

							<tr>
                                <td>Balance (Gross)</td>
                                <td>{{$Gross or ''}}</td>
                            </tr>

							<tr>
                                <td>Less: Commission for the Month</td>
                                <td>{{$CommissionAmount or ''}}</td>
                            </tr>

							<tr>
                                <td>Closing Balance</td>
                                <td>{{$Closing_Balance or ''}}</td>
                            </tr>

							<tr>
                                <td style="background-color: #000;color: white;">Amount available for payout</td>
                                <td style="background-color: #000;color: white;">{{$Available_Payout or ''}}</td>
                            </tr>

							
							
                            
                        </tbody>
                    </table>
			

  
@section('scripts')



    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/ddatatables.js') }}"></script>

@endsection
							</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>


@endsection
@section('scripts')
    <script src="{{ asset('assets/dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
@endsection