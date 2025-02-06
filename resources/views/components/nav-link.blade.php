@props(['href'])

<a {{ $attributes->merge([
    'href' => $href,
    'class' => 'font-medium focus:outline-none ' . (request()->is(ltrim(parse_url($href, PHP_URL_PATH), '/')) ? 'text-blue-500' : 'text-gray-600 hover:text-gray-400'),
    'aria-current' => request()->is(ltrim(parse_url($href, PHP_URL_PATH), '/')) ? 'page' : ''
]) }}>
    {{ $slot }}
</a>
