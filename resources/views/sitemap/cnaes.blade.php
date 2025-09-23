<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cnaes as $cnae)
        <url>
            <loc>{{ route('cnae.show', ['cnae' => $cnae->codigo]) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        </url>
    @endforeach
</urlset>
