<?php
abstract class Dates_DateIterator implements Iterator
{
	/**
	 * Factory method, saves some code, also enable me to put everything in the same class
	 * as we use Autoload to load classes.
	 */
	static public function factory($cycle,DateTime $DateI,DateTime $DateII){
		switch($cycle){
			case 'Daily':
				return new DaysIterator($DateI,$DateII);
			case 'Weekly':
				return new WeeksIterator($DateI,$DateII);
			case 'Monthly':
				return new MonthsIterator($DateI,$DateII);
			case 'Yearly':
				return new YearsIterator($DateI,$DateII);
			default:
				throw(new Exception('No valid cycle was chosen to iterate over'));
		}
	}
	/**
	 * @var DateTime represents the start range.
	 */
	public $FromDate;
	/**
	 * @var DateTime represents the end range.
	 */
	public $ToDate;
	/**
	 * @var DateTime Current Date.
	 */
	protected $CurrentDate;

	public function __construct(DateTime $DateI,DateTime $DateII)
	{
		if($DateII->format('U') > $DateI->format('U'))
		{
			$this->FromDate=$DateI;
			$this->ToDate=$DateII;
			$this->CurrentDate=$DateI;
		}
		else
		{
			$this->FromDate=$DateII;
			$this->ToDate=$DateI;
			$this->CurrentDate=$DateII;
		}
	}//EOF constructor

	/**
	 * @return DateTime
	 */
	public function getClonedCurrent(){
		return clone($this->CurrentDate);
	}

	public function current()
	{
		return $this->CurrentDate;
	}//EOF current

	public function currentDate()
	{
		return $this->CurrentDate->format('Ymd');
	}//EOF current

	public function rewind()
	{
		$this->CurrentDate=$this->FromDate;
	}//EOF rewind

	public function valid()
	{
		//Kill hours/minutes/seconds. If we are to add hours and minutes iterators, we will need to rethink this.
		return (floor($this->CurrentDate->format('U')/(3600*24)) <= floor($this->ToDate->format('U')/(3600*24)));
	}//EOF valid
}//EOF CLASS  DateIterator


class DaysIterator extends Dates_DateIterator
{
	public function __construct(DateTime $DateI,DateTime $DateII)
	{
		parent::__construct($DateI,$DateII);
	}//EOF constructor

	public function next()
	{
		$this->CurrentDate->modify('+1 day');
	}//EOF next

	public function key()
	{
		return $this->CurrentDate->format('d');
	}//EOF key

}//EOD CLASS DaysIterator
