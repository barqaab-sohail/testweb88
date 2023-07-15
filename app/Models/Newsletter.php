<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Newsletter extends Model
{
  use SoftDeletes;
    /**
     * Generated
     */

  protected $table = 'newsletter';
  protected $fillable = ['id', 'name', 'email', 'status','telephone','status'];

	/**
	 * Fetch User Subscribers From DB Table
	 */
	function getSubscribers($item, $page)
	{
		if($page>1){
			$startLimit = ($page-1)*$item;
		}else{
			$startLimit = 0;
		}

		$results = DB::table('newsletter')->orderBy('id','desc')->offset($startLimit)->take($item)->get();
		return $results;
	}


	/**
	 * Get Last Update Record From DB Table
	 */
	function getLastUpdated($withDeleted = False)
  {
    if ($withDeleted)
    {
      $last_updated_item = self::withTrashed()
                               ->orderBy('updated_at', 'desc')
                               ->first();
    }
    else
    {
      $last_updated_item = self::orderBy('updated_at', 'desc')
                               ->first();
    }

    if ($last_updated_item) {
      return $last_updated_item->updated_at;
    }

    return False;
  }


	/**
	 * Insert Subscriber to DB Table
	 */
	function addSubscriber($form_data) {
    if (empty($form_data)) {
      return False;
    }

    $subscriber = new self();

    $subscriber->name      = $form_data['name'];
    $subscriber->email     = $form_data['email'];
    $subscriber->company   = $form_data['company'];
    $subscriber->telephone = $form_data['telephone'];

    if (!empty($form_data['subscriber_status'])) {
      $subscriber->status  = '1';
    }

    if (!$subscriber->save()) {
      return False;
    }

    return True;
  }
	function sendsubscriptionmaildata($formData)
	{
		$mail=$formData['email'];;
		$to = $formData['email'];
		$to_name = $formData['name'];
		$from = 'shop@tbm.com.my';
		$from_name = 'SHOP TBM';
		$subject = " Newsletter Subscribtion with TBM.";
		$message = "Dear ".$formData['name'].",<br><br>";
		$message .= "This is  confirmation  About  successful Subscribtion with TBM.<br/>";

		$message .= "<br><br>HI there!<br>
		You have now been added to the mailing list and will receive the next email informtion in the coming days or weeks. if <br>
		you ever wish to unsbscribe , simply use the unsubscribe link included in each newsletter. We're excited that we'll have <br>
		you as a customer soon!<br>
		in the meantime, come and like us on Facebook!<br><br>

		https://www.facebook.com/tbm2u<br><br>

		Thanks again for signing up!<br><br>

		Thank you,
		Best regards,<br>
		TBM Online Registration Manager<br>
		TAN BOON MING SDN BHD (494355-D)<br>
		PS 4,5,6 & 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.<br>
		Tel: (603) 7983-2020 (Hunting Lines)<br>
		Fax: (603) 7982-8141<br>
		info@tbm.com.my<br>
		Business Hours:<br>
		Mon. - Sat.: 9.30am - 9.00pm<br>
		Sun.: 10.00am - 9.00pm <br/>";

		$headers = "From:".$from . "\r\n" ;
		$headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		mail($to,$subject,$message,$headers);
		return true;
	}

	/**
	 * Update Subscriber to DB Table
	 */
	public function updateSubscriber($form_data) {
    if (empty($form_data)) {
      return False;
    }

    $subscriber = self::find($form_data['subscriber_id']);

    if (empty($subscriber)) {
      return False;
    }

    $subscriber->name      = $form_data['edit_name'];
    $subscriber->email     = $form_data['edit_email'];
    $subscriber->company   = $form_data['edit_company'];
    $subscriber->telephone = $form_data['edit_telephone'];

    if (!empty($form_data['edit_subscriber_status'])) {
      $subscriber->status  = '1';
    } else {
      $subscriber->status  = '0';
    }

    if (!$subscriber->save()) {
      return False;
    }

    return True;
	}


	/**
	 * Delete Subscribers From DB Table
	 */
	function deleteSubscribers($formData)
	{
		DB::table('newsletter')->whereIn('id',explode(',',$formData['subscriberId']))->delete();

	}


	/**
	 * Delete All Subscribers From DB Table
	 */
	function deleteAll()
	{
		DB::table('newsletter')->delete();

	}

}
