
@extends('layout')

@section('content')

<form action="{{ route('users.index') }}" id="userForm" method="GET" onsubmit="return submitForm()">
    <div class="form-group">
      <label for="currency">Currency</label>
      <select class="form-control" name="currency" id="currency">
          <option value="USD">USD</option>
          <option value="GBP">GBP</option>
          <option value="EUR">EUR</option>
      </select>
    </div>    
    <button type="submit" class="btn btn-primary">Get Data</button>
  </form>
    <div id='data' class='mt-4'>
    </div>

    <script>
        $(document).ready(function() {
            loadData();
        });

        function submitForm() {
            let currency = document.getElementById('currency').value;
            loadData(currency);          
            return false;  
        }

        function loadData(currency) {
            $('#data').html('');

            let url = "{{ route('users.index') }}";
            if(currency) {
                url += '?currency=' + currency;
            }
            axios.get(url).then(function (response) {
                console.log(response);
                message = '<table class="table">';
                message += '<tr><th>Name</th><th>Email</th><th>Rate</th></tr>';
                response.data.forEach(user => {
                    message += '<tr><td>' + user.name + '</td><td>' + user.email + '</td><td>' + user.hourly_rate + ' ' + user.currency + '</td></li>'
                });
                message += '</table>';
                $('#data').html(message);
            }).catch(function (error) {
                console.log('error')
            });
        }
    </script>
@endsection
