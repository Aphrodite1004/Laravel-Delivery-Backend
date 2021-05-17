namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
   public $fillable = ['subcat_id','product_name', 'mrp', 'price', 'subscription_price','qty', 'product_image','description', 'stock', 'unit', 'created_at', 'updated_at'];
}