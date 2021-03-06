<?php

namespace App\Console\Commands;

use App\DTO\Product;
use Illuminate\Console\Command;
use App\Helpers\TranslateHelper as TranslateClient;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Jobs\CreateProductOnShopifyJob;

class CreateShopifyProductsFromExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:fromexcel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Shopify Products From Excel File';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TranslateClient $translater)
    {
        //  Get Excel file
        $spreadsheet = IOFactory::load(Storage::path('demo.xls'));
        $productsData = Product::createCollectionFromExcel($spreadsheet);

        //  Create a Shopify product with each line
        foreach ($productsData as $productData) {

            $productToCreate = [
                "title" =>
                $translater->translate($productData->type) . " " .
                    $productData->collection . ", " .
                    $translater->translate($productData->color) . ", " .
                    $productData->sizeName,

                "body_html" => "<strong>" . $translater->translate(
                    $productData->type . " " . $productData->category
                ) . "!</strong>",

                "vendor" => $productData->brand,

                "product_type" => $translater->translate(
                    $productData->type
                ),

                "variants" => [
                    [
                        "sku" => $productData->code,
                        "price" => $productData->price,
                    ]
                ],

                "images" => $productData->images,
            ];

            $this->line($productToCreate["title"] . " creating with " . count($productToCreate["images"]) . " images...");

            $dispatchedJob = CreateProductOnShopifyJob::dispatch($productToCreate);

            $this->info("Create product job has been dipatched.");
            $this->line(" ");
        }

        $this->info("Finished");
    }
}
