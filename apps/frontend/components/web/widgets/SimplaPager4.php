<?php
class SimplaPager4 extends CLinkPager
{
	const CSS_HIDDEN_PAGE = 'hidden';
	const CSS_SELECTED_PAGE = 'current';

	public $nextPageLabel = 'N';
	public $prevPageLabel = 'P';
	public $firstPageLabel = 'F';
	public $lastPageLabel = 'L';
	public $header = '';

	/**
	 * Executes the widget.
	 * This overrides the parent implementation by displaying the generated page buttons.
	 */
	public function run()
	{
		$buttons = $this->createPageButtons();
		if (empty($buttons))
			return;
		echo $this->header;
		echo implode("&nbsp;", $buttons);
		echo $this->footer;
	}
	/**
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 * @param string the text label for the button
	 * @param integer the page number
	 * @param string the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
	 * @param boolean whether this page button is visible
	 * @param boolean whether this page button is selected
	 * @return string the generated button
	 */
	protected function createPageButton($label, $page, $class, $hidden, $selected)
	{
		$page_number = $page + 1;
		switch ($label) {
			case 'F':
				return ($hidden) ? '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&lt;&lt;</a></span>' : '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&lt;&lt;</a></span>';

				break;
			case 'P':
				return ($hidden) ? '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&lt;</a></span>' : '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&lt;</a></span>';
				break;
			case 'N':
				return ($hidden) ? '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="next_page">&gt;</a></span>' : '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="next_page">&gt;</a></span>';
				break;
			case 'L':
				return ($hidden) ? '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&gt;&gt;</a></span>' : '<span><a href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)"  id="last_page">&gt;&gt;</a></span>';
				break;
			default:
				if ($selected) {
					return ' <span><a class="current" href="#">' . $label . '</a></span>';
				} else {
					return '<span><a class="page-links" href="javascript:void(0)"  data-page="' . $page_number . '" onclick="setPagenumber(this)" >' . $label . '</a></span>';
				}
				break;
		}


		//echo "<p style='background:#000;color:#fff'>label:".$label."page:".$page."selected:".$selected."</p><br />";

	}

	/**
	 * Creates the URL suitable for pagination.
	 * This method is mainly called by pagers when creating URLs used to
	 * perform pagination. The default implementation is to call
	 * the controller's createUrl method with the page information.
	 * You may override this method if your URL scheme is not the same as
	 * the one supported by the controller's createUrl method.
	 * @param CController the controller that will create the actual URL
	 * @param integer the page that the URL should point to. This is a zero-based index.
	 * @return string the created URL
	 */
}
