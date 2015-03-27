<?php echo "<?php\n"; ?>

class DefaultController extends Controller
{
	public $breadcrumbs;
	public function actionIndex()
	{
		$this->render('index');
	}
}
