@extends('layouts.app')
@section('content')
<section class="py-5 bg-light">
  <div class="container">
    <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
      <div class="col-lg-6">
        <h1 class="h2 text-uppercase mb-0">Wish List</h1>
      </div>
      <div class="col-lg-6 text-lg-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('frontend.wishlist') }}">Wish List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <h2 class="h5 text-uppercase mb-4">Wish List</h2>
  <div class="row">
    <div class="col-lg-12 mb-4 mb-lg-0">
      <!-- CART TABLE-->
      <div class="table-responsive mb-4">
        <table class="table text-nowrap">
          <thead class="bg-light">
            <tr>
              <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
              <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
              <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Move to cart</strong></th>
              <th class="border-0 p-3" scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @forelse (Cart::instance('wishlist')->content() as $item)
              <livewire:frontend.wish-list-item-component :item="$item->rowId" :key="$item->rowId"/>
            @empty
              <td class="pl-0 border-light" colspan="5">
                <p class="text-center">
                  No Items found in your wish list!
                </p>
              </td>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</section>
@endsection