<?php

namespace App\Console\Commands\Generators;

use Illuminate\Support\Str;
use App\Console\Commands\CrudGenerator;
use App\Console\Commands\CrudMakeCommand;

class Lang extends CrudGenerator
{
    public static function generate(CrudMakeCommand $command)
    {
        $name = Str::of($command->argument('name'))->plural()->snake();

        $translatable = $command->option('translatable');
        $hasMedia = $command->option('has-media');

        if ($translatable && $hasMedia) {
            $stub = __DIR__.'/../stubs/lang/translatable_media_lang.stub';
        } elseif ($translatable && ! $hasMedia) {
            $stub = __DIR__.'/../stubs/lang/translatable_lang.stub';
        } elseif (! $translatable && $hasMedia) {
            $stub = __DIR__.'/../stubs/lang/media_lang.stub';
        } else {
            $stub = __DIR__.'/../stubs/lang/lang.stub';
        }

        static::put(
            resource_path("lang/en"),
            $name.'.php',
            self::qualifyContent(
                $stub,
                $name,
                'en'
            )
        );

        static::put(
            resource_path("lang/ar"),
            $name.'.php',
            self::qualifyContent(
                $stub,
                $name,
                'ar'
            )
        );
    }

    protected static function qualifyContent($stub, $name, $lang = null)
    {
        $replaceArray = static::englishResourceLang($name);
        if ($lang == 'ar') {
            $replaceArray = static::arabicResourceLang($name);
        }

        return str_replace(
            [
                "{{singular}}",
                "{{plural}}",
                "{{empty}}",
                "{{count}}",
                "{{search}}",
                "{{select}}",
                "{{perPage}}",
                "{{filter}}",
                "{{actions.list}}",
                "{{actions.create}}",
                "{{actions.show}}",
                "{{actions.edit}}",
                "{{actions.delete}}",
                "{{actions.options}}",
                "{{actions.save}}",
                "{{actions.filter}}",
                "{{messages.created}}",
                "{{messages.updated}}",
                "{{messages.deleted}}",
                "{{attributes.name}}",
                "{{attributes.%name%}}",
                "{{attributes.image}}",
                "{{dialogs.delete.title}}",
                "{{dialogs.delete.info}}",
                "{{dialogs.delete.confirm}}",
                "{{dialogs.delete.cancel}}",
            ],
            $replaceArray,
            file_get_contents($stub)
        );
    }

    public static function arabicResourceLang($resource)
    {
        $name = (string) Str::of($resource)->singular()->snake();

        if (! isset(static::arabicWords()[$name])) {
            throw new \Exception("The '$name' word doesn't register.");
        }

        $names = static::arabicWords()[$name];

        $singular1 = $names[0];
        $singular2 = $names[2];
        $plural1 = $names[1];
        $plural2 = $names[3];

        return [
            $singular1,
            $plural1,
            "لا يوجد $plural2 حتى الان",
            "عدد $plural1",
            "بحث",
            "اختر $singular1",
            "عدد النتائج بالصفحة",
            "ابحث عن $singular2",
            "عرض الكل",
            "اضافة $singular2",
            "عرض $singular1",
            "تعديل $singular1",
            "حذف $singular1",
            "خيارات",
            "حفظ",
            "بحث",
            "تم اضافة $singular1 بنجاح.",
            "تم تعديل $singular1 بنجاح.",
            "تم حذف $singular1 بنجاح.",
            "اسم $singular1",
            "اسم $singular1",
            "صورة $singular1",
            "تحذير !",
            "هل انت متأكد انك تريد حذف $singular1",
            "حذف",
            "الغاء",
        ];
    }

    public static function englishResourceLang($resource)
    {
        $studlySingular = Str::of($resource)->singular()->studly();
        $studlyPlural = Str::of($resource)->plural()->studly();
        $lowercaseSingular = Str::of($resource)->singular()->lower();
        $lowercasePlural = Str::of($resource)->plural()->lower();

        return [
            $studlySingular,
            $studlyPlural,
            "There are no $lowercasePlural yet.",
            "$studlyPlural Count.",
            "Search",
            "Select $studlySingular",
            "Results Per Page",
            "Search for $lowercaseSingular",
            "List All",
            "Create a new $lowercaseSingular",
            "Show $lowercaseSingular",
            "Edit $lowercaseSingular",
            "Delete $lowercaseSingular",
            "Options",
            "Save",
            "Filter",
            "The $lowercaseSingular has been created successfully.",
            "The $lowercaseSingular has been updated successfully.",
            "The $lowercaseSingular has been deleted successfully.",
            "$studlySingular name",
            "$studlySingular name",
            "$studlySingular image",
            "Warning !",
            "Are you sure you want to delete the $lowercaseSingular?",
            "Delete",
            "Cancel",
        ];
    }

    public static function arabicWords()
    {
        return [
            'category' => ['القسم', 'الاقسام', 'قسم', 'اقسام'],
            'brand' => ['الماركة', 'الماركات', 'ماركة', 'ماركات'],
            'country' => ['الدولة', 'الدول', 'دولة', 'دول'],
            'city' => ['المدينة', 'المدن', 'مدينة', 'مدن'],
            'room' => ['الغرفة', 'الغرف', 'غرفة', 'غرف'],
            'collection' => ['الكولكشن', 'الكولكشن', 'كوليكشن', 'كوليكشن'],
            'tester' => ['التيستر', 'التيستر', 'تيستر', 'تيستر'],
            'page' => ['الصفحة', 'الصفحات الثابته', 'صفحة', 'صفحات'],
            'size' => ['الحجم', 'الاحجام', 'حجم', 'احجام'],
        ];
    }
}
