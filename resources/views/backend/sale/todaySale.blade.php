@extends ('backend.layouts.app')

@section('title', 'Sales List')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Today Sales List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
            <li class="breadcrumb-item active">Sales list</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header ">
              <h3 class="card-title">Book Sales List</h3><br>
              <div>
                <a href="{{route('transactions.create')}}" class="btn btn-info">New Transaction</a>
              </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#SL</th>
                    <th>Customer name</th>
                    <th>Total Quantity</th>
                    <th>Discount</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sales as $key => $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->customer->name ?? 'N/A' }}</td>
                    <td>{{ $item->total_quantity }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->total_price }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection
