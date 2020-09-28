
@extends('layout')

@section('content')

<form action="{{ route('users.store') }}" id="userForm" method="POST" onsubmit="return submitForm()">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" required class="form-control" id="name">
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" required id="email" name="email">
    </div>
    <div class="form-group">
      <label for="hourly_rate">Hourly Rate</label>
      <input type="number" min="1.0" step="0.01" required class="form-control" name="hourly_rate" id="hourly_rate">
      <select class="form-control" name="currency" id="currency">
          <option value="USD">USD</option>
          <option value="GBP">GBP</option>
          <option value="EUR">EUR</option>
      </select>
    </div>    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <script>
      function submitForm() {
          axios.post('{{ route('users.store') }}', {
              name: document.getElementById('name').value,
              email: document.getElementById('email').value,
              hourly_rate: document.getElementById('hourly_rate').value,
              currency: document.getElementById('currency').value,
          }).then(function(response) {
              alert('Created');
              document.getElementById('userForm').reset();
          }).catch(function(error) {
              alert('Error Occurred');
          });
          return false;
      }
  </script>
@endsection
