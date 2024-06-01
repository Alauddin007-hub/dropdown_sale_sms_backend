@extends ('backend.layouts.app')

@section('title', 'New Transaction')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                <li>{{$err}}</li>
                                @endforeach
                            </div>
                            @endif

                            <form action="{{ route('transactions.store') }}" method="POST" class="form-produk">
                                @csrf
                                <div class="form-group row">
                                    <label for="customer_id" class="col-lg-2">Customer :</label>
                                    <div class="col-lg-5">
                                        <select name="customer_id" id="customer_id" class="form-control">
                                            <option selected>Select Customer</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="book_search" class="col-lg-2">Select Book:</label>
                                    <div class="col-lg-5">
                                        <select name="book_id" id="book_search" class="form-control">
                                            <option value="" disabled selected>Search for books...</option>
                                            @foreach ($books as $item)
                                            <option data-toggle="modal" data-target="#modal-book" value="{{$item->id}}" data-price="{{$item->price}}">{{$item->book_bangla_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-book"><i class="fa fa-search-plus"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped table-sale">
                                                <thead>
                                                    <tr>
                                                        <th>#SL</th>
                                                        <th>Book</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Discount (%)</th>
                                                        <th>Sub-total</th>
                                                        <th width="15%"><i class="fa fa-cog"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sale-details">
                                                    <!-- Sale details will be dynamically added here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Total <span id="total-price">0.00</span></h4>
                                            </div>
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary">Save Transaction</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-book" tabindex="-1" role="dialog" aria-labelledby="modal-book">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Select Product</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="book-search-input" class="form-control" placeholder="Search for books...">
                <table class="table table-striped table-bordered table-product table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody id="book-list">
                        <!-- Book search results will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // When a book is selected from the dropdown
        $('#book_search').on('change', function() {
            const selectedBookId = $(this).val();
            const selectedBookName = $(this).find('option:selected').text();
            const selectedBookPrice = $(this).find('option:selected').data('price');

            if (selectedBookId) {
                const query = selectedBookName;
                if (query.length >= 2) {
                    fetch(`/books/search?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            let html = '';
                            data.forEach((item, index) => {
                                html += `
                                <tr>
                                    <td width="5%">${index + 1}</td>
                                    <td>${item.book_id}</td>
                                    <td>${item.book.book_bangla_name}</td>
                                    <td>${item.price}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs btn-flat select-product" data-book-id="${item.book.id}" data-book-name="${item.book.book_bangla_name}" data-price="${item.price}">
                                            <i class="fa fa-check-circle"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            `;
                            });
                            $('#book-list').html(html);
                        });
                }
            }
        });

        // Event delegation to handle dynamically added buttons
        $(document).on('click', '.select-product', function() {
            const bookId = $(this).data('book-id');
            const bookName = $(this).data('book-name');
            const price = $(this).data('price');
            selectProduct(bookId, bookName, price);
        });

        // Function to select a product and add it to the sale details
        function selectProduct(bookId, bookName, price) {
            const index = $('#sale-details tr').length;
            const row = `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <input type="hidden" name="books[${index}][book_id]" value="${bookId}">
                    ${bookName}
                </td>
                <td><input type="number" name="books[${index}][quantity]" class="form-control" onchange="updateTotal(${index}, ${price})" min="1" value="1"></td>
                <td>
                    <input type="hidden" name="books[${index}][price]" value="${price}">
                    ${price}
                </td>
                <td><input type="number" name="books[${index}][discount]" class="form-control" onchange="updateTotal(${index}, ${price})" value="0"></td>
                <td><input type="text" name="books[${index}][subtotal]" class="form-control" value="${price.toFixed(2)}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-xs remove-product" data-index="${index}"><i class="fa fa-times"></i></button></td>
            </tr>
        `;
            $('#sale-details').append(row);
            calculateTotal();
        }

        // Event delegation to handle dynamically added remove buttons
        $(document).on('click', '.remove-product', function() {
            const index = $(this).data('index');
            removeProduct(index);
        });

        window.updateTotal = function(index, price) {
            const quantityElement = $(`input[name="books[${index}][quantity]"]`);
            const discountElement = $(`input[name="books[${index}][discount]"]`);
            const quantity = parseFloat(quantityElement.val());
            const discount = parseFloat(discountElement.val());
            const subtotal = (quantity * price) * ((100 - discount) / 100);
            $(`input[name="books[${index}][subtotal]"]`).val(subtotal.toFixed(2));
            calculateTotal();
        };

        function calculateTotal() {
            let total = 0;
            $('input[name$="[subtotal]"]').each(function() {
                total += parseFloat($(this).val());
            });
            $('#total-price').text(total.toFixed(2));
        }

        window.removeProduct = function(index) {
            $(`#sale-details tr:eq(${index})`).remove();
            calculateTotal();
        };
    });
</script>


@endsection