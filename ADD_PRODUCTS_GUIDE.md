# 📦 Способы добавить товары с картинками в магазин

## 🎯 Краткое резюме структуры

Ваш проект использует:
- **Laravel** - фреймворк
- **Eloquent ORM** - работа с БД
- **Factories** - генерация тестовых данных
- **Seeders** - заполнение БД начальными данными
- **Products & ProductImages** - модели для товаров и картинок

---

## ✅ Способ 1: Использование сидера (Рекомендуется)

### Шаг 1: Запустить сидер
```bash
php artisan db:seed --class="Database\Seeders\DummyData\ProductWithImagesSeeder"
```

Или если хотите очистить старые данные:
```bash
php artisan migrate:fresh --seed
```

### Что происходит:
- ✅ Создаются 15 товаров с описаниями
- ✅ У каждого товара 2-4 дополнительных изображений
- ✅ Товары распределены по 7 категориям
- ✅ Используются реальные изображения с `picsum.photos` (сервис случайных картинок)

---

## 💻 Способ 2: PHP Artisan Tinker (интерактивная консоль)

```bash
php artisan tinker
```

Затем выполните команды:

```php
// Создать категорию
$category = \App\Models\ProductCategory::firstOrCreate(
    ['name' => 'Electronics'],
    ['slug' => 'electronics']
);

// Создать товар
$product = \App\Models\Product::create([
    'name' => 'iPhone 15 Pro',
    'category_id' => $category->id,
    'price' => 999.99,
    'short_description' => 'Latest iPhone model',
    'long_description' => 'Full description here...',
    'featured_image' => 'https://picsum.photos/640/480?random=1',
    'inventory_count' => 50,
    'low_stock_threshold' => 5,
]);

// Добавить дополнительные изображения
$product->images()->create([
    'image' => 'https://picsum.photos/640/480?random=2',
    'order' => 1,
]);

$product->images()->create([
    'image' => 'https://picsum.photos/640/480?random=3',
    'order' => 2,
]);

// Проверить результат
$product->load('images');
$product->toArray();
```

---

## 🏭 Способ 3: Использование Factory (для тестов)

В PHP Tinker или тестах:

```php
// Создать 10 товаров с картинками через Factory
$products = \App\Models\Product::factory(10)->create();

// Добавить каждому по 3 изображения
$products->each(function ($product) {
    \App\Models\ProductImage::factory(3)->create([
        'product_id' => $product->id,
    ]);
});
```

---

## 📝 Способ 4: Массовое добавление из JSON

Создайте файл `products.json`:

```json
[
    {
        "name": "MacBook Pro M3",
        "price": 1999.99,
        "category": "Electronics",
        "featured_image": "https://picsum.photos/640/480?random=1",
        "images": [
            "https://picsum.photos/640/480?random=2",
            "https://picsum.photos/640/480?random=3"
        ]
    },
    {
        "name": "Sony WH-1000XM5",
        "price": 399.99,
        "category": "Electronics",
        "featured_image": "https://picsum.photos/640/480?random=4",
        "images": [
            "https://picsum.photos/640/480?random=5"
        ]
    }
]
```

Затем используйте эту команду в Tinker:

```php
$data = json_decode(file_get_contents('products.json'), true);

foreach ($data as $item) {
    $category = \App\Models\ProductCategory::firstOrCreate(
        ['name' => $item['category']],
        ['slug' => \Illuminate\Support\Str::slug($item['category'])]
    );

    $product = \App\Models\Product::create([
        'name' => $item['name'],
        'price' => $item['price'],
        'category_id' => $category->id,
        'featured_image' => $item['featured_image'],
        'inventory_count' => 50,
    ]);

    foreach ($item['images'] as $index => $imageUrl) {
        $product->images()->create([
            'image' => $imageUrl,
            'order' => $index + 1,
        ]);
    }
}
```

---

## 🖼️ Способ 5: Загрузка локальных изображений

Если хотите использовать свои файлы:

```php
// 1. Поместите файлы в public/images/products/
// 2. Создайте товар с локальным путём:

$product = \App\Models\Product::create([
    'name' => 'Мой товар',
    'price' => 99.99,
    'category_id' => 1,
    'featured_image' => 'images/products/product-1.jpg',
    'inventory_count' => 50,
]);

// 3. Добавьте изображения
$product->images()->create([
    'image' => 'images/products/product-1-alt.jpg',
    'order' => 1,
]);
```

---

## 🎨 Источники изображений для тестирования

- **picsum.photos** - Случайные картинки (используется в сидере)
- **unsplash.com** - Реальные фото высокого качества
- **pexels.com** - Бесплатные стоки фото
- **placeholder.com** - Плейсхолдеры (например: `https://via.placeholder.com/640x480`)

---

## 📊 Проверка добавленных товаров

### В Tinker:
```php
// Показать количество товаров
\App\Models\Product::count();

// Показать товары с изображениями
\App\Models\Product::with('images')->get();

// Показать товар с категорией и изображениями
\App\Models\Product::where('name', 'iPhone 15 Pro')
    ->with(['category', 'images'])
    ->first();
```

### В браузере (если у вас есть API):
```
GET /api/products
GET /api/products/1
GET /api/products/1/images
```

---

## 🗑️ Удаление товаров (если нужно начать заново)

```php
// Удалить все товары (удалятся и изображения автоматически)
\App\Models\Product::truncate();

// Или конкретный товар
\App\Models\Product::find(1)->delete();
```

---

## 🚀 Быстрый старт (3 команды)

```bash
# 1. Очистить БД и применить миграции
php artisan migrate:fresh

# 2. Заполнить БД начальными данными
php artisan db:seed

# 3. Проверить результат
php artisan tinker
>>> \App\Models\Product::count()
```

---

## 🛠️ Структура БД

```
products
├── id
├── name
├── price
├── featured_image ← основная картинка
├── category_id
├── inventory_count
└── ... другие поля

product_images
├── id
├── product_id
├── image ← дополнительные картинки
└── order ← порядок показа
```

---

## 📌 Примечание о картинках

В созданном сидере используются **внешние URL** (picsum.photos). Это удобно для тестирования, но для production рекомендуется:

1. **Загружать изображения локально** в `storage/app/public`
2. **Использовать Storage facade**:

```php
$path = \Illuminate\Support\Facades\Storage::disk('public')
    ->putFile('products', $uploadedFile);

$product->featured_image = $path;
$product->save();
```

---

Выберите способ, который вам больше подходит! 🎉
