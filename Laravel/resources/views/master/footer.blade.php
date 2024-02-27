<footer>
    <div class="bg-light py-4">
        <div class="container text-center w-100 mx-auto">
          <p class="text-muted mb-0 py-2"> © 2023 ATEC - All rights reserved. <span onclick="triggerIntro()">Tutorial</span></p>
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
