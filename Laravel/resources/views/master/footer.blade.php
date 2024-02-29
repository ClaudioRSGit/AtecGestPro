<footer>
    <div class="bg-light py-4">
        <div class="container text-center w-100 mx-auto">
            @php
                $user = Auth::user();
            @endphp
          <p class="text-muted mb-0 py-2"> © {{ date('Y') }} ATEC - All rights reserved.
            @if($user->role_id != 2)
                  <span onclick="triggerIntro();" style="cursor: pointer;">Tutorial</span>
            @endif


          </p>
        </div>
    </div>
</footer>
@push('scripts')
<script src="{{ asset('js/userOnboarding/intro.js') }}"></script>
@endpush


<style>
        footer {
        bottom: 0;
        width: 100%;
        color: #fff;
        text-align: center;
    }
</style>
