<?

class navigation
{
	public $_stack_nav;

	public function __construct()
	{
		//
		$this->_stack_nav = [];
	}

	public function set_breadcrumb($title_brd = "")
	{
		$this->_stack_nav[] = $title_brd;
	}
}