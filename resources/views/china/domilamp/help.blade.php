@extends('layouts.common')
@section('main')
    <section>
        <div class="container">
            <p>出厂初始状态下，任何一盏DomiLamp无需任何配置即可与周围（有效通信距离内）的一盏或多盏DomiLamp实现联动。</p>
            <p>如果您有多盏DomiLamp，并且有意让不同房间或区域的灯组独立工作，则必须配置私有组群，以确保任何一组和其他DomiLamp不产生联动。注意：如果您在每个房间或区域仅有一盏DomiLamp，则只需通过释放各自的Domi按键来解除联动功能。Domi按键说明参见Domi功能说明（此处跳转到之前manual里对Domi功能的说明那一章节）</p>

            <h3>新建私有组群</h3>
            <p>该操作用于多盏DomiLamp的首次分组。</p>

            <p>步骤：</p>
            <ol>
                <li>将需要成组的DomiLamp就近放置并开启至任一档位；</li>
                <li>翻转以上任何一盏DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），短压组群键并释放；</li>
                <span style="margin-left: -1.2em">然后：</span>
                <li>就近的、已开启的DomiLamp将自动加入成组；</li>
                <li>已成组的所有DomiLamp将自动进入白光高亮模式，并以此提示新建组群操作成功。</li>
            </ol>

            <p>注意：</p>
            <p>私有组群建立过程持续时间仅为3秒，请务必提前打开待入群的DomiLamp。</p>

            <h3>加入私有组群</h3>
            <p>该操作用于将一盏或多盏DomiLamp加入一个已经存在的组群。</p>

            <p>步骤：</p>
            <ol>
                <li>开启已有组群内的任何一盏DomiLamp至任一档位；</li>
                <li>将待加入组群的DomiLamp就近放置于已有组群并开启至任一档位；</li>
                <li>翻转待加入组群的DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），短压组群键并释放；</li>
                <span style="margin-left: -1.2em">然后：</span>

                <li>待加入组群的DomiLamp将自动加入就近的组群；</li>
                <li>已加入组群的DomiLamp将自动调整档位，光效与该组群保持一致，并以此提示加入已有组群操作成功。</li>
            </ol>

            <p>注意：</p>
            <p>如果待加入私有组群的DomiLamp本身位于另外一个组群内，则短压组群键不会导致其加入新的其他组群，除非其先从已有的组群内脱离。</p>

            <h3>脱离私有组群</h3>
            <p>该操作用于将一盏或多盏DomiLamp从一个私有组群内移除。</p>

            <p>步骤：</p>
            <ol>
                <li>开启待脱离组群的一盏或多盏DomiLamp至任一档位；</li>
                <li>翻转待脱离组群的DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），长压（2秒以上）组群键并释放；</li>
                <span style="margin-left: -1.2em">然后：</span>

                <li>待脱离组群的DomiLamp将自动脱离组群；</li>
                <li>已脱离组群的DomiLamp将在短暂震动后自动熄灭，并以此提示脱离组群操作成功。</li>
            </ol>

            <p>注意：</p>
            <p>脱离私有组群的DomiLamp将恢复到出厂初始状态，可以与任何不在私有群组内的一盏或多盏DomiLamp联动。</p>
        </div>
    </section>



@endsection