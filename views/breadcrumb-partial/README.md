#### Install
Add the `breadcrumbs.blade.php` file to your `/resources/views/partials` folder

### Usage
```
@php 
$breadcrumbs = [
	['href' => route('places.index'), 'text' => 'Places'], 
	['text' => 'Add a new place']]; 
@endphp
@include('partials.breadcrumbs', $breadcrumbs);
```

In your layout, you can do:
```
<div class="container">
    @yield('breadcrumbs')
    @yield('content')
</div>
```
