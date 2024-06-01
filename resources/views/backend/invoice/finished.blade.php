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
                                

                                <div class="box-footer">
                                    <button class="btn btn-warning btn-flat" onclick="bignote('{{ route('transactions.big_note') }}', 'PDF Invoice')">Print Invoice</button>
                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-flat">New Transaction</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    function bignote(url, title) {
        popupCenter(url, title, 900, 675);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft;
        const top = (height - h) / 2 / systemZoom + dualScreenTop;
        const newWindow = window.open(url, title,
            `
            scrollbars=yes,
            width=${w / systemZoom}, 
            height=${h / systemZoom}, 
            top=${top}, 
            left=${left}
        `
        );

        if (window.focus) newWindow.focus();
    }

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



