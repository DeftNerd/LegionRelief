@foreach ($categories as $category)

<a href="/categories/{{ $category->name }}">
<span class="category-label label label-default" style="font-size: .90em; line-height: 2;">{{ $category->name }}</span>
</a>

@endforeach