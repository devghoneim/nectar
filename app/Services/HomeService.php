<?php
namespace App\Services;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Label;
use App\Models\Location;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HomeService
{

  public function __construct(  private CategoryService $categoryService,
        private BrandService $brandService,
        private ProductService $productService,
        private SubCategoryService $subCategoryService,
        private LocationService $locationService,
        private BannerService $bannerService,
        private LabelService $labelService)
  {   
  }

    

    
   
    
  

    public function index()
    {

        $data['location'] = $this->locationService->getUserLocations();
        $data['banner'] = $this->bannerService->index();
        $data['label'] =$this->labelService->getLabelWithProduct();
        $data['category'] =$this->categoryService->CategoryWithProduct();
        return $data;
    }


    public function product($id)
    { 
       return $this->productService->show($id);
    }


    public function search($name)
    {
      
      $data['cat'] = $this->categoryService->findCategoryByName($name);
      
      $data['brand'] = $this->brandService->findBrandByName($name);
     
      $data['pro'] = $this->productService->findProductByName($name);
      
      $data['sub_cat'] = $this->subCategoryService->findSubCategoryByName($name);

      return $data;

    }

    public function productBySearch($data)
    {
      switch ($data['model']) {
        case 'brand':
          return $this->productService->findProductByBrand($data['id']) ;
        case 'category':
          return $this->productService->findProductByCategory($data['id']) ;
          case 'sub_category':
          return $this->productService->findProductBySubCategory($data['id']) ;
        default:
        throw ValidationException::withMessages(['model' => 'Invalid model']);
      }
    }
}