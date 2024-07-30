<div id="mailing-container">
    <div id="mailing-list">
        <div id="ml-wrapper">
            <table>
                <tr id="ml-headings">
                    <th width=100>email</th>
                </tr>
                @foreach ($users as $user)
                    <td> {{ $user->email }} </td>
                @endforeach
            </table>
        </div>
    </div>
    <div>dsa</div>
</div>
