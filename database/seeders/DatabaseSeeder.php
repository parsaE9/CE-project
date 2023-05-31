<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $web_skills = array(
            "HTML",
            "CSS",
            "JavaScript",
            "PHP",
            "MySQL",
            "SEO",
            "Responsive",
            "Agile",
            "Security",
            "Web Design",
            "User Experience (UX)",
            "User Interface (UI)",
            "Content Management System (CMS)",
            "WordPress",
            "Joomla",
            "Drupal",
            "Magento",
            "Shopify",
            "E-commerce",
            "Payment Gateway",
            "Bootstrap",
            "jQuery",
            "Node.js",
            "Angular",
            "React",
            "Vue.js",
            "Front-end Development",
            "Back-end Development",
            "Full-stack Development",
            "API Development",
            "Web Services",
            "RESTful",
            "SOAP",
            "Authentication",
            "Authorization",
            "JSON",
            "XML",
            "CodeIgniter",
            "Laravel",
            "Symfony",
            "Django",
            "Flask",
            "Express",
            "Socket.io",
            "Websockets",
            "Progressive Web Apps (PWA)",
            "Serverless",
            "Cloud Computing",
            "Amazon Web Services (AWS)",
            "Google Cloud Platform (GCP)"
        );

        Skill::insert(array_map( function ($v) {
            return [
                "name" => $v,
                "description" => $v
            ];
        }, $web_skills));



        $categories = array(
            "IT و برنامه‌نویسی",
            "بازاریابی و فروش",
            "حسابداری و مالی",
            "مهندسی و فنی",
            "طراحی و هنر",
            "آموزش و پژوهش",
            "پشتیبانی و خدمات مشتریان",
            "مدیریت و مشاوره",
            "سلامت و پزشکی",
            "حقوقی و قانونی",
            "رستوران و غذا",
            "مد و زیبایی",
            "سفر و گردشگری",
            "خودرو و حمل‌ونقل",
            "ساخت و ساز و عمران"
        );

        Category::insert(array_map( function ($v) {
            return [
                "name" => $v,
            ];
        }, $categories));

    }
}
