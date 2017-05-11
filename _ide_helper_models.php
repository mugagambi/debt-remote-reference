<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\DueListing
 *
 * @property-read \App\Profile $customer
 */
	class DueListing extends \Eloquent {}
}

namespace App{
/**
 * App\Profile
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DueListing[] $due_listings
 */
	class Profile extends \Eloquent {}
}

