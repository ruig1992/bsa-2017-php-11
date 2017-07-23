@component('mail::message')
# A new car has been added!

Hello, **{{ $user }}**! The **"{{ config('app.name') }}"** has good news for you!

The new car has just been added to our list. And this means that you have more opportunities "to sweep by the breeze". :-)

## Car Short Information
@component('mail::table')
|           |                     |
| --------- | ------------------- |
| **Model** | {{ $car['model'] }} |
| **Year**  | {{ $car['year'] }}  |
| **Color** | {{ $car['color'] }} |
@endcomponent

@component('mail::button', ['url' => route('cars.show', ['id' => $car['id']])])
View more
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
