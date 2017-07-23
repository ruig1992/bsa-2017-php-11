<p>Hello, {{ $user }}!</p>

<p>A new car has been stored successfully!</p>

<dl>
  <dt>Model</dt>
  <dd>{{ $car['model'] }}</dd>

  <dt>Registration number</dt>
  <dd>{{ $car['registration_number'] }}</dd>

  <dt>Year</dt>
  <dd>{{ $car['year'] }}</dd>

  <dt>Mileage</dt>
  <dd>{{ $car['mileage'] }}</dd>

  <dt>Color</dt>
  <dd>{{ $car['color'] }}</dd>

  <dt>Price</dt>
  <dd>{{ $car['price'] }}</dd>
</dl>
