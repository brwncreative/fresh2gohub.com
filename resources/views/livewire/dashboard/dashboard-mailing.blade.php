<div id="mailing-container">
    <div id="mailing-list" class="center">
        <div id="ml-wrapper" class="center">
            <div id="ml-tb-wrapper">
                <table table-layout:fixed>
                    <tr id="ml-headings">
                        <th width=100>E-mail</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->email }} </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div></div>
</div>
