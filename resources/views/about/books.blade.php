@extends('layouts.app')

@section('content')

<h1>Laravel Books</h1>

<p>
Hopefully the LaraBrain is helping you to resolve a few immediate questions however be sure to consider one of the following books if you're in need of more comprehensive instruction.
</p>


<div class="row book">
<div class="col-md-4">
<a href="http://www.easylaravelbook.com/"><img src="/images/el5-book.png" /></a>
</div>
<div class="book-description">
<h2>Easy Laravel 5</h2>

<p>
Written by bestselling author and PHP veteran W. Jason Gilmore, <emphasis>Easy Laravel 5</emphasis> has been an incredibly popular book since the very day it was released. Regularly updated (see the <a href="http://www.easylaravelbook.com/changelog">changelog</a>), and introducing Laravel features in the context of a real-world project, reading this book is sure to turn you into a proficient Laravel developer in an incredibly short period of time.
</p>

<p>
Learn more about and purchase the book at <a href="http://www.easylaravelbook.com">EasyLaravelBook.com</a>
</p>

</div>
</div>

<div class="row book">
<div class="col-md-4">
<a href="http://easyecommercebook.com/">
<img src="/images/eels-book.jpg" />
</a>
</div>
<div class="book-description">
<h2>Easy E-Commerce Using Laravel and Stripe</h2>

<p>
Co-authored by <a href="https://laravel-news.com/">Laravel News</a> creator Eric L. Barnes and bestselling author W. Jason Gilmore, <emphasis>Easy E-Commerce Using Laravel and Stripe</emphasis> guides you through the creation of a real-world Laravel- and Stripe-powered website. You'll learn how to sell products, create a shopping cart, and manage monthly subscriptions using Laravel, Stripe, and the Laravel Cashier package.
</div>

</div>

@endsection

