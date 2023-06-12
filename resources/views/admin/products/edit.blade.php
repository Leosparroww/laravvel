 @extends('admin.layouts.master')
 @section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
         <div class="section__content section__content--p30">
             <div class="container-fluid">
                 <div class="offset-3 col-6">
                     @if (session('updateSuccess'))
                         <div class="alert alert-success alert-dismissible fade show ms-5 " role="alert">
                             <span>{{ session('updateSuccess') }}</span>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                     @endif
                 </div>
                 <div class="col-lg-10 offset-1">
                     <div class="card">
                         <div class="card-body">
                             <div class="card-title">

                                 <i class="fa-solid fa-arrow-left text-black" onclick="history.back()"></i>
                                 <h3 class="text-center title-2"> Pizza Details</h3>
                             </div>
                             <hr>
                             <div class="row">
                                 <div class="col-3 offset-1 ">
                                     <img src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                         class="img-thumbnail shadow-sm ">
                                 </div>
                                 <div class=" offset-1 col-8 bg-success-subtle  rounded p-2 ps-4">
                                     <form action="">

                                         <h4>
                                             <table class="table table-sm">
                                                 <tbody>
                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-pizza-slice"></i>
                                                         </td>
                                                         <td class="text-danger">{{ $pizza->name }}</td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-money-bill-1-wave"></i>
                                                         </td>
                                                         <td>{{ $pizza->price }}</td>
                                                     </tr>


                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-hourglass-half"></i>

                                                         </td>
                                                         <td>{{ $pizza->waiting_time }}</td>
                                                     </tr>

                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-bars"></i>

                                                         </td>
                                                         <td>{{ $pizza->category_name }}</td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <i class="fa-regular fa-eye"></i>
                                                         </td>
                                                         <td>{{ $pizza->view_count }}</td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-file-lines d-block"></i>
                                                         </td>
                                                         <td class="bg-warning-subtle p-4 rounded m-3">
                                                             {{ $pizza->description }}
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <i class="fa-solid fa-calendar me-2"></i>

                                                         </td>
                                                         <td>{{ $pizza->created_at }}</td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </h4>

                                     </form>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- END MAIN CONTENT-->
     <!-- END PAGE CONTAINER-->
 @endsection
