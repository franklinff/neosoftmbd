
<h3>Village - Society - Area Report :(Village : {{$village_names}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
    <tr>
        <th>Sr.No</th>
        <th>Village Name</th>
        <th>Village Total Area(m.sq.)</th>
        <th>Society Name</th>
        <th>Society Area(m.sq.)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($dataListMaster as $key => $data)
        <tr>
            <td>{{$data['id']}}</td>
            <td>{{$data['Village Name']}}</td>
            <td>{{$data['Village Total Area(m.sq.)']}}</td>
            <td>{{$data['Society Name']}}</td>
            <td>{{$data['Society Area(m.sq.)']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
