@if ($errors->any())
    <div class="alert alert-danger" id="errorAlert" style="position: fixed; top: 20px; right: 20px; z-index: 1000; transition: opacity 0.5s ease;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('errorAlert');
            setTimeout(() => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); 
                }
            }, 3000);
        });
    </script>

@endif

@if (session('success'))
    <div class="alert alert-success" id="successAlert" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
        {{ session('success') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('successAlert');
            setTimeout(() => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        });
    </script>
@endif


