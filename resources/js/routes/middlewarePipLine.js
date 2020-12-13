export default function middlewarePipLine(context,middleware,index){
const nextMiddleware = middleware[index];
if(!nextMiddleware){
    return context.next
}

return () => {
const nextPipline =middlewarePipLine(context,middleware,index + 1)
nextMiddleware({...context, next:nextPipline});
}
}



