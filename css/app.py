def apply_parallel(fs,xs):
    i=0
    output_list=[]
    no_fs=len(fs)
    
    if fs==[]:
        print(xs)
    else:    
        for x in xs:
            output_list.append(fs[i](x))
            if i==no_fs-1:
                i=no_fs-1
            else:
                i+=1
    
        print(output_list)
   
            
def test_apply():
     s=lambda x:x*x
     c=lambda x:x*x*x
     
     apply_parallel([],[1,2,3])==[1,2,3]
     apply_parallel([s,s],[])==[]
     apply_parallel([s,s,c],[1,2,3,4])==[1,4,27,64]
     apply_parallel([s,s,c,c,c],[1,2,3,4])==[1,4,27,64]
test_apply()
# programed by : satvik