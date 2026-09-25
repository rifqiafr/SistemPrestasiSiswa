<?php

use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure Non-Akademik category exists
        $nonAkademik = Category::firstOrCreate(
            ['slug' => 'non-akademik'],
            ['name' => 'Non-Akademik', 'is_active' => true]
        );

        // 2. Find old categories (Olahraga, Seni, Riset)
        $oldCategories = Category::whereIn('slug', ['olahraga', 'seni', 'riset'])
            ->orWhereIn('name', ['Olahraga', 'Seni', 'Riset'])
            ->get();

        $oldCategoryIds = $oldCategories->pluck('id')->filter(fn ($id) => $id !== $nonAkademik->id)->all();

        if (! empty($oldCategoryIds)) {
            // Re-point all achievements to Non-Akademik
            Achievement::whereIn('category_id', $oldCategoryIds)->update([
                'category_id' => $nonAkademik->id,
            ]);

            // Remove obsolete categories
            Category::whereIn('id', $oldCategoryIds)->delete();
        }

        // 3. Ensure Akademik is active
        Category::where('slug', 'akademik')->update([
            'name' => 'Akademik',
            'is_active' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Category::firstOrCreate(['slug' => 'olahraga'], ['name' => 'Olahraga', 'is_active' => true]);
        Category::firstOrCreate(['slug' => 'seni'], ['name' => 'Seni', 'is_active' => true]);
        Category::firstOrCreate(['slug' => 'riset'], ['name' => 'Riset', 'is_active' => true]);
    }
};
