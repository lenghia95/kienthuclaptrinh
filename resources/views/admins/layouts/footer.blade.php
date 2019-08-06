<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> {!! App\Models\Config::getByKey('sitename_part2') !!}
    </div>
    {!! App\Models\Config::getByKey('copyright') !!}
</footer>
