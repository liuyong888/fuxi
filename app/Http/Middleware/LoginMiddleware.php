<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //中间件过滤数据的核心 操作方法  $request请求报文  Closure $next下一个请求
    public function handle($request, Closure $next)
    {
        //检测当前有没有登录的session信息
        if($request->session()->has('name')){
            // 获取访问模块控制器和方法名(来源于百度)
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            // 控制器的名字
            $controllerName=$func[0];
            // 方法名
            $actionName=$func[1];
            // echo $controllerName.'--'.$actionName;
            // 4.获取访问模块的控制器和方法 与用户的权限列表作对比
            $nodeList=session('nodeList');
            if(empty($nodeList[$controllerName]) || !in_array($actionName,$nodeList[$controllerName])){
                return redirect("/admin")->with("error","抱歉,您没有没有权限访问该模块,请联系超级管理员");
            }
            //执行下个请求
            return $next($request);
        }else{
            //跳转到登录界面
            return redirect("/adminlogin/create");
        }
        
    }
}
