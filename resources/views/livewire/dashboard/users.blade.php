<main id="dashboard">
    @foreach ($users as $user)
        {{json_encode($user)}}
    @endforeach
</main>
